<?php

  // Get Configuration Info
  include "/usr/share/supportit/config.php";
  $DATE = date('Y-m-d H:i:s');

  // Connect to Mail Server
  $mbox = imap_open("{".$MAIL_CONNECT['Host'].":".$MAIL_CONNECT['Port']."}".$MAIL_CONNECT['Folder'], $MAIL_CONNECT['Username'], $MAIL_CONNECT['Password']) or die("can't connect: " . imap_last_error());
  $MC = imap_check($mbox);

  // Connect to SQL
  $conn = new mysqli($DB_CONNECT['Host'], $DB_CONNECT['Username'], $DB_CONNECT['Password'], $DB_CONNECT['Database']);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // End of Line
  if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
    $eol="\r\n";
  } elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
    $eol="\r";
  } else {
    $eol="\n";
  }

  // Init Var
  $Ready=0;

  // Fetch an overview for all messages in Folder
  $mail_result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);

  // Generate Tickets
  foreach ($mail_result as $email) {
    echo "############################################\n";
    echo "Working on ".$email->msgno."\n";
    echo "############################################\n";
    // Verify Validity of email and if it comes from website
    if (( $email->from == "LaswitchTech <info@laswitchtech.com>" ) and ( $email->subject == "New Message From LaswitchTech" )){
      echo "############################################\n";
      echo "Creating ticket from website\n";
      echo "############################################\n";
      // Get Email Info
      $mail_body = imap_qprint(imap_body($mbox, $email->msgno));
      $tag = substr($mail_body, strpos($mail_body, '[email]')+7);
      $mail_address = substr($tag, 0, strpos($tag, '[endemail]'));
      $tag = substr($mail_body, strpos($mail_body, '[subject]')+9);
      $mail_subjet = substr($tag, 0, strpos($tag, '[endsubject]'));
      $tag = substr($mail_body, strpos($mail_body, '[description]')+13);
      $mail_description = substr($tag, 0, strpos($tag, '[enddescription]'));
      // Mail is ready
      $Ready=1;
    } else {
      echo "############################################\n";
      echo "Creating ticket from email\n";
      echo "############################################\n";
      // Decode email
      $encoding_type = imap_fetchstructure($mbox, $email->msgno);
      $mail_body = imap_body($mbox, $email->msgno);
      $mail_body = utf8_encode(quoted_printable_decode($mail_body));

      echo "--------------------------------------------\n";
      echo "encoding_type=> ".$encoding_type."\n";
      echo "encoding_type[0]=> ".$encoding_type[0]."\n";
      echo "encoding_type[1]=> ".$encoding_type[1]."\n";
      echo "encoding_type[2]=> ".$encoding_type[2]."\n";
      echo "encoding_type[3]=> ".$encoding_type[3]."\n";
      echo "--------------------------------------------\n";

      // Get Email Info
      $tag = substr($email->from, strpos($email->from, '<')+1);
      $mail_address = substr($tag, 0, strpos($tag, '>'));
      $mail_subjet=$email->subject;
      $mail_description=$mail_body;
      // Mail is ready
      $Ready=1;
    }
    if ($Ready == 1){
      echo "############################################\n";
      echo "Sending a reply\n";
      echo "############################################\n";
      echo "--------------------------------------------\n";
      echo "mail_address=> ".$mail_address."\n";
      echo "mail_subjet=> ".$mail_subjet."\n";
      echo "mail_description=> ".$mail_description."\n";
      echo "--------------------------------------------\n";
      // Fetch Contact
      $sql = "SELECT * FROM contacts WHERE email='".$mail_address."';";
      $contact_result = $conn->query($sql);

      if( $contact_result ){
        $contact = mysqli_fetch_assoc($contact_result);
        if ( $contact_result->num_rows > 0 ){
          if ( $email->seen == 0 ){
            $sql = "INSERT INTO tickets ( owner, created, modified, account_id, contact_id, state, status, priority, type, subject, description, user_id ) VALUES ( 2, '".$DATE."', '".$DATE."', '".$contact['account_id']."', '".$contact['id']."', 0, 0, 3, 1, '".$mail_subjet."', '".$mail_description."', 1 )";
            if ($conn->query($sql) === TRUE) {
              $last_id = $conn->insert_id;
              // Multiple recipients
              $to = "$mail_address"; // note the comma

              // Subject
              $subject = "Ticket#$last_id has been created";

              // Message
              $message = "
<html>
<head>
  <title>Ticket#$last_id has been created</title>
</head>
<body>
  <p>Here are the details of your ticket</p>
  <table>
    <tr>
      <th>E-mail</th>
      <th>Subject</th>
      <th>Issue</th>
    </tr>
    <tr>
      <td>$mail_address</td>
      <td>$mail_subjet</td>
      <td>$mail_description</td>
    </tr>
  </table>
</body>
</html>
              ";

              // To send HTML mail, the Content-type header must be set
              $headers[] = 'MIME-Version: 1.0';
              $headers[] = 'Content-type: text/html; charset=iso-8859-1';

              // Additional headers
              $headers[] = "To: You <$mail_address>";
              $headers[] = "From: Support Team <support@laswitchtech.com>";
              //$headers[] = "Cc: birthdayarchive@example.com";
              //$headers[] = "Bcc: birthdaycheck@example.com";

              // Mail it
              mail($to, $subject, $message, implode("\r\n", $headers));

              // Delete Mail
              imap_delete($mbox, $email->msgno);
              imap_expunge($mbox);

              $statement = $subject;

              //Update log
              $sql = "INSERT INTO logs ( owner, created, modified, type, tbl, content, user_id, is_success ) VALUES ( 1, '".$DATE."', '".$DATE."', 1, 'tickets', '".$statement."', 1, 1 )";
              if ($conn->query($sql) === TRUE) {
                echo "Log Updated";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              //Update log
              $sql = "INSERT INTO logs ( owner, created, modified, type, tbl, content, user_id, is_success ) VALUES ( 1, '".$DATE."', '".$DATE."', 1, 'tickets', '".$statement."', 1, 0 )";
              if ($conn->query($sql) === TRUE) {
                echo "Log Updated";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }
          }
        }
      }
    }
  }

  // Close both connections
  imap_close($mbox);
  $conn->close();
?>

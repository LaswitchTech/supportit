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

  function getBody($uid, $mbox) {
    $body = get_part($mbox, $uid, "TEXT/HTML");
    // if HTML body is empty, try getting text body
    if ($body == "") {
        $body = get_part($mbox, $uid, "TEXT/PLAIN");
    }
    return $body;
  }

  function get_part($mbox, $uid, $mimetype, $structure = false, $partNumber = false) {
      if (!$structure) {
             $structure = imap_fetchstructure($mbox, $uid, FT_UID);
      }
      if ($structure) {
          if ($mimetype == get_mime_type($structure)) {
              if (!$partNumber) {
                  $partNumber = 1;
              }
              $text = imap_fetchbody($mbox, $uid, $partNumber, FT_UID);
              switch ($structure->encoding) {
                  case 3: return imap_base64($text);
                  case 4: return imap_qprint($text);
                  default: return $text;
             }
         }

          // multipart
          if ($structure->type == 1) {
              foreach ($structure->parts as $index => $subStruct) {
                  $prefix = "";
                  if ($partNumber) {
                      $prefix = $partNumber . ".";
                  }
                  $data = get_part($mbox, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
                  if ($data) {
                      return $data;
                  }
              }
          }
      }
      return false;
  }

  function get_mime_type($structure) {
      $primaryMimetype = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");

      if ($structure->subtype) {
         return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
      }
      return "TEXT/PLAIN";
  }

  // Fetch an overview for all messages in Folder
  $mail_result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);

  // Generate Tickets
  foreach ($mail_result as $email) {
    echo "Working on ".$email->msgno."\n";
    // Verify Validity of email and if it comes from website
    if (( $email->from == "LaswitchTech <info@laswitchtech.com>" ) and ( $email->subject == "New Message From LaswitchTech" )){
      echo "Creating ticket from website\n";
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
      echo "Creating ticket from email\n";
      // Decode email
      $mail_body = getBody($email->uid, $mbox);

      // Get Email Info
      $tag = substr($email->from, strpos($email->from, '<')+1);
      $mail_address = substr($tag, 0, strpos($tag, '>'));
      $mail_subjet=$email->subject;
      $mail_description=$mail_body;
      // Mail is ready
      $Ready=1;
    }
    if ($Ready == 1){
      echo "Sending a reply\n";
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
Ticket#$last_id has been created\n
\n
Content of the ticket : \n
  E-mail : $mail_address\n
  Ticket Subject : $mail_subjet\n
  Ticket Issue : \n
  ---------------------------------------------------------------------------------------------------------\n
  $mail_description\n
  ---------------------------------------------------------------------------------------------------------\n
              ";

              // To send HTML mail, the Content-type header must be set
              $headers[] = 'MIME-Version: 1.0';
              $headers[] = 'Content-type: text/html; charset=iso-8859-1';

              // Additional headers
              $headers[] = "To: You <$mail_address>";
              $headers[] = "From: Support Team <support@laswitchtech.com>";
              //$headers[] = "Cc: Support Team <support@laswitchtech.com>";
              //$headers[] = "Bcc: Support Team <support@laswitchtech.com>";

              // Mail it
              mail($to, $subject, $message, implode("\r\n", $headers));

              echo "###########################################################\n";
              echo "to=> ".$to."\n";
              echo "subject=> ".$subject."\n";
              //echo "message=> ".$message."\n";
              echo "###########################################################\n";

              // Delete Mail
              imap_delete($mbox, $email->msgno);
              imap_expunge($mbox);

              // Set mail as unread
              //imap_clearflag_full($mbox, $email->msgno, "//Seen");

              $statement = $subject;

              //Update log
              $sql = "INSERT INTO logs ( owner, created, modified, type, tbl, content, user_id, is_success ) VALUES ( 1, '".$DATE."', '".$DATE."', 1, 'tickets', '".$statement."', 1, 1 )";
              if ($conn->query($sql) === TRUE) {
                echo "Log Updated\n";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              //Update log
              $sql = "INSERT INTO logs ( owner, created, modified, type, tbl, content, user_id, is_success ) VALUES ( 1, '".$DATE."', '".$DATE."', 1, 'tickets', '".$statement."', 1, 0 )";
              if ($conn->query($sql) === TRUE) {
                echo "Log Updated\n";
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

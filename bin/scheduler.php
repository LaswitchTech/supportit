<?php

  // End of Line
  if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
    $eol="\r\n";
  } elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
    $eol="\r";
  } else {
    $eol="\n";
  }

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

  // Fetch an overview for all messages in Folder
  $mail_result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);

  // Generate Tickets
  foreach ($mail_result as $email) {

    // Get Email Info
    $mail_body = imap_qprint(imap_body($mbox, $email->msgno));
    $tag = substr($mail_body, strpos($mail_body, '[email]')+7);
    $mail_address = substr($tag, 0, strpos($tag, '[\email]'));
    $tag = substr($mail_body, strpos($mail_body, '[subject]')+9);
    $mail_subjet = substr($tag, 0, strpos($tag, '[\subject]'));
    $tag = substr($mail_body, strpos($mail_body, '[description]')+13);
    $mail_description = substr($tag, 0, strpos($tag, '[\description]'));

    // Fetch Contact
    $sql = "SELECT * FROM contacts WHERE email=".$mail_address;
    $contact_result = $conn->query($sql);
    $contact = mysqli_fetch_assoc($contact_result);

    // Verify Existence of User and Verify Mail Issuer for New Ticket
    if ($contact_result->num_rows > 0){
      if ( $email->subject == "New Message From LaswitchTech" ){
        if ( $email->from == "LaswitchTech <info@laswitchtech.com>" ){
          if ( $email->seen == 0 ){
            $sql = "INSERT INTO tickets ( owner, created, modified, account_id, contact_id, state, status, priority, type, subject, description, resolution, user_id ) VALUES ( 2, $DATE, $DATE, $contact->account_id, $contact->id, 0, 0, 3, 1, $mail_subjet, $mail_description, '', 1 )";

            if ($conn->query($sql) === TRUE) {
              $last_id = $conn->insert_id;
              # To Email Address
              $emailaddress=$mail_address;
              # Message Subject
              $emailsubject="Ticket#".$last_id." has been created";

              # Common Headers
              $headers .= 'From: LaswitchTech-Support <support@laswitchtech.com>'.$eol;
              $headers .= 'Reply-To: LaswitchTech-Support <support@laswitchtech.com>'.$eol;
              $headers .= 'Return-Path: LaswitchTech-Support <support@laswitchtech.com>'.$eol;     // these two to set reply address
              $headers .= "Message-ID:<".$DATE." system@laswitchtech.com>".$eol;
              $headers .= "X-Mailer: PHP v".phpversion().$eol;           // These two to help avoid spam-filters
              # Boundry for marking the split & Multitype Headers
              $mime_boundary=md5(time());
              $headers .= 'MIME-Version: 1.0'.$eol;
              $headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol;
              $msg = "";

              # Text Version
              $msg .= "--".$mime_boundary.$eol;
              $msg .= "Content-Type: text/plain; charset=iso-8859-1".$eol;
              $msg .= "Content-Transfer-Encoding: 8bit".$eol;
              $msg .= "This is a multi-part message in MIME format.".$eol;
              $msg .= "If you are reading this, please update your email-reading-software.".$eol;
              $msg .= "+ + Text Only Email from Genius Jon + +".$eol.$eol;

              # Finished
              $msg .= "--".$mime_boundary."--".$eol.$eol;   // finish with two eol's for better security. see Injection.

              # SEND THE EMAIL
              ini_set(sendmail_from,'support@laswitchtech.com');  // the INI lines are to force the From Address to be used !
              mail($emailaddress, $emailsubject, $msg, $headers);
              ini_restore(sendmail_from);

              //Update log
              $sql = "INSERT INTO logs ( owner, created, modified, type, tbl, content, user_id, ipv4, is_success ) VALUES ( 1, $DATE, $DATE, 1, 'tickets', $sql, 1, $_SERVER["REMOTE_ADDR"], 1 )";
              if ($conn->query($sql) === TRUE) {
                echo "Log Updated"
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              //Update log
              $sql = "INSERT INTO logs ( owner, created, modified, type, tbl, content, user_id, ipv4, is_success ) VALUES ( 1, $DATE, $DATE, 1, 'tickets', $sql, 1, $_SERVER["REMOTE_ADDR"], 0 )";
              if ($conn->query($sql) === TRUE) {
                echo "Log Updated"
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

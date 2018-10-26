<?php

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

  // Decoding
  function decodeBase64($text) {
    $this->tickle();
    return imap_base64($text);
  }
  /**
   * Decodes quoted-printable text.
   *
   * @param $text (string)
   *   Quoted printable text to convert.
   *
   * @return (string)
   *   Decoded text.
   */
  function decodeQuotedPrintable($text) {
    return quoted_printable_decode($text);
  }
  /**
   * Decodes 8-Bit text.
   *
   * @param $text (string)
   *   8-Bit text to convert.
   *
   * @return (string)
   *   Decoded text.
   */
  function decode8Bit($text) {
    return quoted_printable_decode(imap_8bit($text));
  }
  /**
   * Decodes 7-Bit text.
   *
   * PHP seems to think that most emails are 7BIT-encoded, therefore this
   * decoding method assumes that text passed through may actually be base64-
   * encoded, quoted-printable encoded, or just plain text. Instead of passing
   * the email directly through a particular decoding function, this method
   * runs through a bunch of common encoding schemes to try to decode everything
   * and simply end up with something *resembling* plain text.
   *
   * Results are not guaranteed, but it's pretty good at what it does.
   *
   * @param $text (string)
   *   7-Bit text to convert.
   *
   * @return (string)
   *   Decoded text.
   */
  function decode7Bit($text) {
    // If there are no spaces on the first line, assume that the body is
    // actually base64-encoded, and decode it.
    $lines = explode("\r\n", $text);
    $first_line_words = explode(' ', $lines[0]);
    if ($first_line_words[0] == $lines[0]) {
      $text = base64_decode($text);
    }
    // Manually convert common encoded characters into their UTF-8 equivalents.
    $characters = array(
      '=20' => ' ', // space.
      '=2C' => ',', // comma.
      '=E2=80=99' => "'", // single quote.
      '=0A' => "\r\n", // line break.
      '=0D' => "\r\n", // carriage return.
      '=A0' => ' ', // non-breaking space.
      '=B9' => '$sup1', // 1 superscript.
      '=C2=A0' => ' ', // non-breaking space.
      "=\r\n" => '', // joined line.
      '=E2=80=A6' => '&hellip;', // ellipsis.
      '=E2=80=A2' => '&bull;', // bullet.
      '=E2=80=93' => '&ndash;', // en dash.
      '=E2=80=94' => '&mdash;', // em dash.
    );
    // Loop through the encoded characters and replace any that are found.
    foreach ($characters as $key => $value) {
      $text = str_replace($key, $value, $text);
    }
    return $text;
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

      // Get the message body.
      $body = imap_fetchbody($mbox, $email->msgno, 1.2);
      if (!strlen($body) > 0) {
        $body = imap_fetchbody($mbox, $email->msgno, 1);
      }
      // Get the message body encoding.
      $encoding = getEncodingType($email->msgno);
      // Decode body into plaintext (8bit, 7bit, and binary are exempt).
      if ($encoding == 'BASE64') {
        $body = decodeBase64($body);
      } elseif ($encoding == 'QUOTED-PRINTABLE') {
        $body = decodeQuotedPrintable($body);
      } elseif ($encoding == '8BIT') {
        $body = decode8Bit($body);
      } elseif ($encoding == '7BIT') {
        $body = decode7Bit($body);
      }



      echo "--------------------------------------------\n";
      echo "body=> ".$body."\n";
      echo "--------------------------------------------\n";

      // Get Email Info
      $mail_body = $body;
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

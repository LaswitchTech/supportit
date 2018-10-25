<?php
  // Get Configuration Info
  include "/usr/share/supportit/config.php";

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

    // Verify Existence of User and Verify Mail Issuer
    if ($contact_result->num_rows > 0){
      if ( $email->subject == "New Message From LaswitchTech" ){
        if ( $email->from == "LaswitchTech <info@laswitchtech.com>" ){
          if ( $email->seen == 0 ){

          }
        }
      }
    }
  }

  // Close both connections
  imap_close($mbox);
  $conn->close();
?>
<?php

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      }
  } else {
      echo "0 results";
  }


  $sql = "INSERT INTO tickets (firstname, lastname, email)
  VALUES ('John', 'Doe', 'john@example.com')";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }




  // Fetch an overview for all messages in Folder
  $result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
  foreach ($result as $email) {

  //    echo "#{$overview->msgno} ({$overview->date}) - From: {$overview->from}
  //    {$overview->subject}
  //    {$overview->message_id}\n";
      echo "\n";
      echo "################################################################\n";
      echo "subject : {$overview->subject}\n";
      echo "from : {$overview->from}\n";
      echo "to : {$overview->to}\n";
      echo "date : {$overview->date}\n";
      echo "message_id : {$overview->message_id}\n";
      echo "references : {$overview->references}\n";
      echo "in_reply_to : {$overview->in_reply_to}\n";
      echo "size : {$overview->size}\n";
      echo "uid : {$overview->uid}\n";
      echo "msgno : {$overview->msgno}\n";
      echo "recent : {$overview->recent}\n";
      echo "flagged : {$overview->flagged}\n";
      echo "answered : {$overview->answered}\n";
      echo "deleted : {$overview->deleted}\n";
      echo "seen : {$overview->seen}\n";
      echo "draft : {$overview->draft}\n";
      echo "udate : {$overview->udate}\n";
      $message=imap_qprint(imap_body($mbox, $overview->msgno));
      echo "message :\n {$message}\n";
      echo "################################################################\n";
  }








imap_close($mbox);
$conn->close();
?>

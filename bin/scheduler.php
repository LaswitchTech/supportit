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
  $result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
  foreach ($result as $email) {
    if ( $email->subject == "New Message From LaswitchTech" ){
      if ( $email->from == "LaswitchTech <info@laswitchtech.com>" ){
        
      }
    }
  }

  // Close both connections
  imap_close($mbox);
  $conn->close();
?>
<?php


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

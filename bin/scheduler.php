<?php
$mbox = imap_open("{laswitchtech.com:143}INBOX", "support@laswitchtech.com", "Raphy0610+-")
     or die("can't connect: " . imap_last_error());

$MC = imap_check($mbox);

// Fetch an overview for all messages in INBOX
$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
foreach ($result as $overview) {
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
?>

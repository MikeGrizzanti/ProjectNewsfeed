<?php

$message_text = "";
$message_timestamp = time();
$_SESSION['user_id'] = $user_id;
$_SESSION['groupChat_id'] = $groupChat_id;
$error = "";
$erg = "";

if ($_POST) {
    if (isset($_POST['message_box_chat'])) {
        $message_text = trim($_POST['message_box_chat']);
        
        if (empty($message_text)) {
            $error = 'Nothing to send';
        } else {
            $erg = tb_message::saveMessage($message_timestamp, $user_id, $message_text, $groupChat_id);
        }
    }
}


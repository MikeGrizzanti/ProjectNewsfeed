<?php

$message_text = "";
$message_timestamp = time();
$user_id = $_SESSION['id'];
$error = "";
$erg = "";

if ($_POST) {
    if (isset($_POST['message_box_text_box'])) {
        $message_text = trim($_POST['message_box_text_box']);
        
        if (empty($message_text)) {
            $error = 'Nothing to send';
        } else {
            $erg = tb_message::saveMessage($message_timestamp, $user_id, $message_text, $groupChat_id);
        }
    }
}


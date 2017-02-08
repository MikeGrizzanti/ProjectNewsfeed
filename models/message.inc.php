<?php

$message_text = "";
$message_timestamp = time();
$user_id = $_SESSION['id'];
//tb_message::getUserIdFromCategory($_SESSION['category_id']);
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


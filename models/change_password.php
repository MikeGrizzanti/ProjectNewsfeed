<?php

$oldPassword = "";
$repeat_oldPasswort = "";
$newPassword = "";
$error = "";

if ($_POST) {
    if (isset($_POST['text_field_old_password']) && isset($_POST['text_field_repeat_old_password']) && isset($_POST['text_field_new_password'])) {
        $oldPassword = trim($_POST['text_field_old_password']);
        $repeat_oldPasswort = trim($_POST['text_field_repeat_old_password']);
        $newPassword = trim($_POST['text_field_new_password']);
        
        if (empty($oldPassword) || empty($repeat_oldPasswort) || empty($newPassword)) {
            $error = 'Please fill all fields';
        } else {
            $passwordHashed = password_hash($oldPassword, PASSWORD_DEFAULT);
            if (($oldPassword == $repeat_oldPasswort) && ($passwordHashed == tb_user::getOldPw($_SESSION['id']))) {
                $erg = tb_user::changePassword($_SESSION['id']);
                if ($erg != NULL) {
                    header('Location: index.php?action=main');
                } else
                    $error = "Something went wrong";
            }
        }
    }
}


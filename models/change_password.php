<?php

$oldPassword = "";
$repeat_newPassword = "";
$newPassword = "";
$error = "";

if ($_POST) {
    if (is_loggedIn() == TRUE) {
        if (isset($_POST['text_field_old_password']) && isset($_POST['text_field_repeat_new_password']) && isset($_POST['text_field_new_password'])) {
            $oldPassword = trim($_POST['text_field_old_password']);
            $newPassword = trim($_POST['text_field_new_password']);
            $repeat_newPassword = trim($_POST['text_field_repeat_new_password']);

            if (empty($oldPassword) ||  empty($newPassword) || empty($repeat_newPassword)) {
                $error = 'Please fill all fields';
            } else {
                $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
                if (($newPassword === $repeat_newPassword) && (password_verify($oldPassword, tb_user::getOldPw($_SESSION['id'])))) {
                    $erg = tb_user::changePassword($newPasswordHashed, $_SESSION['id']);
                    if ($erg != NULL) {
                        header('Location: index.php?action=main');
                    } else
                        $error = "Something went wrong while changing your password";
                }
            }
        }
    }
}


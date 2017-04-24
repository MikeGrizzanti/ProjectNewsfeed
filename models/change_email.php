<?php
$oldEmail = "";
$repeat_newEmail = "";
$newEmail = "";
$error = "";

if ($_POST) {
    if (is_loggedIn() == TRUE) {
        if (isset($_POST['text_field_old_email']) && isset($_POST['text_field_new_email']) && isset($_POST['text_field_repeat_new_email'])) {
            $oldEmail = trim($_POST['text_field_old_email']);
            $newEmail = trim($_POST['text_field_new_email']);
            $repeat_newEmail = trim($_POST['text_field_repeat_new_email']);

            if (empty($oldEmail) || empty($newEmail) || empty($repeat_newEmail)) {
                $error = 'Please fill all fields';
            } else {
                
                if (($newEmail == $repeat_newEmail) && ($oldEmail == tb_user::getOldEmail($_SESSION['id']))) {
                    $erg = tb_user::changeEmail($newEmail, $_SESSION['id']);
                    if (!(is_null($erg))) {
                        $_SESSION['email'] = tb_user::getnewEmail($_SESSION['id']);
                        header('Location: index.php?action=main');
                    } else
                        $error = "Something went wrong while changing your email, please try again";
                }
            }
        }
    }
}

<?php

$oldEmail = "";
$repeat_oldEmail = "";
$newEmail = "";
$error = "";

if ($_POST) {
    if (is_loggedIn() == TRUE) {
        if (isset($_POST['text_field_old_email']) && isset($_POST['text_field_repeat_old_email']) && isset($_POST['text_field_new_email'])) {
            $oldEmail = trim($_POST['text_field_old_email']);
            $repeat_oldEmail = trim($_POST['text_field_repeat_old_email']);
            $newEmail = trim($_POST['text_field_new_email']);

            if (empty($oldEmail) || empty($repeat_oldPasswort) || empty($newEmail)) {
                $error = 'Please fill all fields';
            } else {
                if ($oldEmail == $repeat_oldEmail) {
                    $erg = tb_user::changeEmail($newEmail, $_SESSION['id']);
                    if ($erg != NULL) {
                        header('Location: index.php?action=main');
                    } else
                        $error = "Something went wrong while changing your email";
                }
            }
        }
    }
}

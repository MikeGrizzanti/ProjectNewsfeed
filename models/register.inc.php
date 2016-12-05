<?php

$user_firstName = "";
$user_lastName = "";
$user_nickName = "";
$user_eMail = "";
$user_password = "";
$user_repeat_password = "";
$error = "";

if ($_POST) {
    if (isset($_POST['text_field_reg_first_name']) && isset($_POST['text_field_reg_last_name']) && isset($_POST['text_field_reg_nick_name']) && isset($_POST['text_field_reg_password']) && isset($_POST['text_field_reg_rep_password']) && isset($_POST['text_field_reg_email'])) {
        $user_firstName = trim($_POST['text_field_reg_first_name']);
        $user_lastName = trim($_POST['text_field_reg_last_name']);
        $user_nickName = trim($_POST['text_field_reg_nick_name']);
        $user_password = trim($_POST['text_field_reg_password']);
        $user_repeat_password = trim($_POST['text_field_reg_rep_password']);
        $user_eMail = trim($_POST['text_field_reg_email']);

        if (empty($user_firstName) || empty($user_lastName) || empty($user_nickName) || empty($user_password) || empty($user_repeat_password) || empty($user_eMail)) {
            $error = "Please fill all fields";
        } else {
            if ($user_password == $user_repeat_password) {
                $erg = User::saveUser(null,$user_firstName, $user_lastName, $user_nickName, $user_password, $user_eMail);
                $_SESSION['id'] = $erg->getId();
                header("Location:index.php?action=main");
            } else {
                $error = "Passwords don't match";
            }
        }
    }
}


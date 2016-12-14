<?php

$user_firstName = "";
$user_lastName = "";
$user_nickName = "";
$user_eMail = "";
$user_password = "";
$user_repeat_password = "";
$error = "";
echo 'gatto';
if ($_POST) {
echo 'kuh';
    if (isset($_POST['text_field_reg_first_name']) && isset($_POST['text_field_reg_last_name']) && isset($_POST['text_field_reg_nickname']) && isset($_POST['text_field_reg_password']) && isset($_POST['text_field_reg_rep_password']) && isset($_POST['text_field_reg_email'])) {
        $user_firstName = trim($_POST['text_field_reg_first_name']);
        $user_lastName = trim($_POST['text_field_reg_last_name']);
        $user_nickName = trim($_POST['text_field_reg_nickname']);
        $user_password = trim($_POST['text_field_reg_password']);
        $user_repeat_password = trim($_POST['text_field_reg_rep_password']);
        $user_eMail = trim($_POST['text_field_reg_email']);
echo 'fisch';
        if (empty($user_firstName) || empty($user_lastName) || empty($user_nickName) || empty($user_password) || empty($user_repeat_password) || empty($user_eMail)) {
echo 'wrong';            
$error = "Please fill all fields";
        } else {
echo 'heideltraud';
            if ($user_password == $user_repeat_password) {
echo 'joseph';
                $erg = tb_user::saveUser(NULL, $firstName, $lastName, $nickName, $password, $eMail);
                $_SESSION['id'] = $erg->getId();
                //header("Location:index.php?action=main");
            } else {
echo 'fungomitsouge';
                $error = "Passwords don't match";
                //header("Location:index.php?action=login");
            }
        }
    }
}

		
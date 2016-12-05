<?php

$user_firstName = "";
$user_lastName = "";
$user_nickName = "";
$user_eMail = "";
$user_password = "";
$user_repeat_password = "";
$error = "";

if ($_POST) {
    if (isset($_POST['user_firstName']) && isset($_POST['user_lastName']) && isset($_POST['user_nickName']) && isset($_POST['user_password']) && isset($_POST['user_repeat_password']) && isset($_POST['user_eMail'])) {
        $user_firstName = trim($_POST['user_firstName']);
        $user_lastName = trim($_POST['user_lastName']);
        $user_nickName = trim($_POST['user_nickName']);
        $user_password = trim($_POST['user_password']);
        $user_repeat_password = trim($_POST['user_repeat_password']);
        $user_eMail = trim($_POST['user_eMail']);

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


<?php

$user_nickName = "";
$user_password = "";
$error = "";

if ($_POST) {
    if (isset($_POST['text_field_nickname']) && isset($_POST['text_field_password'])) {
        $user_nickName = trim($_POST['text_field_nickname']);
        $user_password = trim($_POST['text_field_password']);
        
        if (empty($user_nickName) || empty($user_password)) {
            $error = "Empty username and/or password";
        } else {
            $erg = tb_user::checkLogin($user_nickName, $user_password);
            if ($erg == null) 
                $error = "Wrong username and/or password";
            else {
                $_SESSION['id'] = $erg->getId();
                header("Location:index.php?action=main");
            }
        }
    }   
}




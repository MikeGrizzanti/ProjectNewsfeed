<?php

//0 -> Email not verifyied
//1 -> Email verifyied

$eMail = '';
$id = '';
$info = '';
$errorStatus = '';

if ($_GET) {
    if (isset($_GET['email']) && isset($_GET['id'])) {
        $eMail = $_GET['email'];
        $id = $_GET['id'];
        
        $user = tb_user::getUserFromId($id);
        
        if (!$user) {
            header('Location:error_404.php');
        } else {
            if ($eMail == $user->getEmail()) {
                tb_user::update_user_status(1,$id);
                $info = "Congratulations, your email was verifyied succsessfully!";
            } else
                $info = "Email verification failed.";
        }
    }
}



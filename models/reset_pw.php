<?php

$eMail = "";
$id = "";
$info = "";
$error = "";

if ($_GET) {
    if (isset($_GET['email']) && isset($_GET['id'])) {
        $eMail = $_GET['email'];
        $id = $_GET['id'];
        
        $user = tb_user::getUserFromId($id);
        
        if (!$user) 
            header('Location:404.php');
        else {
            if ($eMail == $user->getEmail()) {
                tb_user::updatePassword($id);
                $info = "Congratulations, your password was reset successfully";
            } else
                $info = "A problem occured while updating your password";
        }
    }
}

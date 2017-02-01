<?php

$user_firstName = "";
$user_lastName = "";
$user_nickName = "";
$user_eMail = "";
$user_password = "";
$user_repeat_password = "";
$error = "";

if ($_POST) {
    if (isset($_POST['text_field_reg_first_name']) && isset($_POST['text_field_reg_last_name']) && isset($_POST['text_field_reg_nickname']) && isset($_POST['text_field_reg_password']) && isset($_POST['text_field_reg_rep_password']) && isset($_POST['text_field_reg_email'])) {
        $user_firstName = trim($_POST['text_field_reg_first_name']);
        $user_lastName = trim($_POST['text_field_reg_last_name']);
        $user_nickName = trim($_POST['text_field_reg_nickname']);
        $user_password = trim($_POST['text_field_reg_password']);
        $user_repeat_password = trim($_POST['text_field_reg_rep_password']);
        $user_eMail = trim($_POST['text_field_reg_email']);

        if (empty($user_firstName) || empty($user_lastName) || empty($user_nickName) || empty($user_password) || empty($user_repeat_password) || empty($user_eMail)) {          
            $error = "Please fill all fields";
        } else {
            if ($user_password == $user_repeat_password) {
                $erg = tb_user::saveUser(NULL, $user_firstName, $user_lastName, $user_nickName, $user_password, $user_eMail);
                if ($erg != null){
                    $_SESSION['id'] = $erg->getId();
                    header("Location:index.php?action=main");
                    
                    //Bestätigungsemail
                    $mail = new PHPMailer;
                    $mail->CharSet = "UTF-8";
                    $mail->From = "support@mindfeed.esy.es";
                    $mail->FromName = "mindfeed.esy.es";
                    $mail->Sender = "support@mindfeed.esy.es";
                    
                    $mail->addAddress($erg->getEmail());
                    $mail->Subject = "Verify registration on mindfeed.esy.es";
                    
                    $mail->isHTML(TRUE);
                    $mail->Body = "<h3>Hello " .$erg->getFirstName() ."</h3>"
                                . "<p> You logged in on our site mindfeed.esy.es with this email."
                                . "<p> Please click on the following link to verify your email: <p>"
                                . "<a> href=mindfeed.esy.es/index.php?action=status&email="
                                . $erg->getEmail()
                                . "&id="
                                . $erg->getId()
                                . ">mindfeed.esy.es</a>";
                    
                    $mail->AltBody = "You were registered on our site. Please copy the following link and paste it in your browser: http://mindfeed.esy.es/index.php?action=status&email="
                                . $erg->getEmail()
                                . "&id="
                                . $erg->getId();
                    
                    if (!$mail->send()) {
                            echo "An error ocurred while sending the email: " . $mail->ErrorInfo;
                    }
                }
                else {
                   $error = "User already exists, please change your email and/or password";
                  
                }
            } else {
                $error = "Passwords don't match";
               
            }
        }
    }
}

		
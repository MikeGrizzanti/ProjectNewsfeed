<?php

$eMail = "";
$error = "";

if ($_POST) {
    if (isset($_POST['text_field_email'])) {
        if (empty($eMail)) {
            $error = "Put in your E-Mail";
        } else {
            
            $user = tb_user::getUserIdFromEmail($eMail);
     
            //Reset-Pw Email
            $mail = new PHPMailer;
            $mail->CharSet = "UTF-8";
            $mail->From = "support@mindfeed.esy.es";
            $mail->FromName = "mindfeed.esy.es";
            $mail->Sender = "support@mindfeed.esy.es";

            $mail->addAddress($eMail);
            $mail->Subject = "mindfeed.esy.es password reset";

            $mail->isHTML(TRUE);
            $mail->Body = "<h3>Hello,</h3>"
                        . "<p> You requested a password reset on our site mindfeed with this email."
                        . "<p> Please click on the following link to reset your password: <p>"
                        . "<a href=mindfeed.esy.es/index.php?action=resetPassword="
                        . $user->getEmail()
                        . "&id="
                        . $user->getId()
                        . ">mindfeed.esy.es</a>";

            $mail->AltBody = "You requested a password-change on our site. Please copy the following link and paste it in your browser: http://mindfeed.esy.es/index.php?action=resetPassword="
                        . $user->getEmail()
                        . "&id="
                        . $user->getId();

            if (!$mail->send()) {
                    echo "An error ocurred while sending the email: " . $mail->ErrorInfo;
            }
        }
    }
}


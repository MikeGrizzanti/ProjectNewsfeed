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


//Facebook-Login
$fb = new Facebook\Facebook([
  'app_id' => '167575093726927', 
  'app_secret' => '{app-secret}',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';


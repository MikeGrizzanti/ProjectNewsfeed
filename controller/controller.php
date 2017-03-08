<?php

require_once 'models/functions.inc.php';


session_start();

class controller {
    
    private $context = array();

    public function run($action){
        $this->$action();
        $this->generatePage($action);
    }
    
    public function login(){
        $erg = is_loggedIn();
        if(!$erg){
            require_once 'models/login.inc.php';
            $this->addContext("error", $error);
        } 
        else 
            header("Location:index.php?action=main");
    }
    
    public function forgotPassword() {
        require_once 'models/forgot_password.php';
        $this->addContext("template", "login");
    }
    
    public function forgotEmail() {
        require_once 'models/forgot_email.php';
        $this->addContext("template", "login");
    }

    public function changeEmail() {
        require_once 'models/change_email.php';
        $this->addContext("template", "logged_in");
    }
    
    public function changePassword() {
        require_once 'models/change_password.php';
        $this->addContext("template", "logged_in");
    }
    
    public function logout() {
        session_destroy();
        header("Location:index.php?action=login");
    }
    
    public function noLogin() {
        $this->addContext("template", "index");
    }
    
    public function main() {
        $erg = is_loggedIn();
        $this->addContext("template", "logged_in");
        $this->addContext("feed_source", $_SESSION['feed_source']);
        $this->addContext("category_name", $_SESSION['category_name']);
        if(!$erg){
            header("Location:index.php?action=login");
        }
    }
    
    public function status() {
        require_once 'models/status.php';
        $this->addContext("template", "logged_in");
    }
    
    public function register() {
        $erg = is_loggedIn();
        require_once 'models/register.inc.php';
        $this->addContext("error", $error);
        $this->addContext("template", "login");
    }
    
    public function user_profile() {
        $erg = is_loggedIn();
        $this->addContext("error", $error);
        $this->addContext("template", "user_profile");
        if (!$erg) {
            header('Location: index.php?action=login');
        }
    }
    
    public function download_feed() {
        $erg = is_loggedIn();
        if(is_loggedIn() && !empty($_POST)){
            require_once 'models/download_feed.inc.php';
            $this->addContext("error", $error);
            $this->addContext("template", "feed");
        }
    }
    private function generatePage($template){
        extract($this->context);
        require_once 'view/'.$template.".tpl.html";
    }
    
    private function addContext($key, $value){
        $this->context[$key] = $value;
    }
}

	
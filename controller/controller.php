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
    
    public function logout() {
        session_destroy();
        header("Location:index.php");
    }
    
    public function main() {
        $erg = is_loggedIn();
        if(!$erg){
            header("Location:index.php");
        } 
    }
    
    public function register() {
        require_once 'models/register.inc.php';
        $this->addContext("error", $error);
    }
    
    private function generatePage($template){
        extract($this->context);
        require_once 'view/'.$template.".tpl.html";
    }
    
    private function addContext($key, $value){
        $this->context[$key] = $value;
    }
}


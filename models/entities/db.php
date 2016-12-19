<?php

class DB {    
    private function __construct() {
        
    }
    
    public static function getDB() {
            $dsn = "mysql:host=mysql.hostinger.de;dbname=u584441810_mindf;charset=utf8mb4";
            $user = "u584441810_admin";
            $password = "hdgf672HH!!";
            try {
                $db = new PDO($dsn, $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                var_dump($db);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }    
        return $db;
    }
}

	
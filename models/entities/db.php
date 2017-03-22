<?php

class DB {    
    private function __construct() {
        
    }
    
    public static function getDB() {
            $dsn = "pgsql:host=mattia98.org;dbname=mindfeed";
            $user = "mindfeed";
            $password = "F8NVn3fL";
            try {
                $db = new PDO($dsn, $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // var_dump($db);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }    
        return $db;
    }
}

	
<?php

class tb_category {
    private $category_id = 0;
    private $fk_category_name = "";
    
    public function __construct($data = array()) {
        if ($data) {
            foreach ($data as $k => $v) {
                $setterName = 'set' . ucfirst($k);
                if (method_exists($this, $setterName)) {
                    $this->$setterName($v);
                }
            }
        }
    }
    
    public function __toString() {
        
    }
    
    public function get_category_Id() {
        return $this->category_id;
    }
    
    private function get_category_name() {
        return $this->category_name;
    }
    
    public static function getCategoryFromID($id) {
        $sql = 'SELECT * FROM tb_category WHERE category_id=?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        return $query->fetch();
    }
    
    public static function getNameFromCategory() {
        $sql = 'SELECT category_name FROM tb_category;';
        $query = DB::getDB()->prepare($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_category');
        return $query->fetchAll();
    }
    
    
}


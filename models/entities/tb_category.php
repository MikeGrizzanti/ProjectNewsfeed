<?php

class tb_category {
    private $category_id = 0;
    private $category_name = "";
    
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
    
    public function get_category_name() {
        return $this->category_name;
    }
    
    public function setCategoryName($category_name) {
        $this->category_name = $category_name;
    }
    
    //we need a function to get the id from the category in order to make it dynmaic html code should be --> value="<?php echo $value->get_category_id() " returning the id of every category from 1 to 10 
    
    public static function getCategoryFromID($id) {
        $sql = 'SELECT * FROM tb_category WHERE category_id=?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_category');
        return $query->fetch();
    }
    
    public static function getNameFromCategory() {
        $sql = 'SELECT category_name FROM tb_category;';
        $query = DB::getDB()->prepare($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_category');
        return $query->fetchAll();
    }
    
    public static function getIdFromCategoryName($name) {
        $sql = 'SELECT category_id FROM tb_category WHERE category_name=?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($name));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_category');
        return $query->fetch();
    }
}


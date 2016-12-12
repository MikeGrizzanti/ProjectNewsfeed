<?php
class tb_user_interests {
    private $fk_user_id = 0;
    private $fk_category_id = 0;
    
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
    
    public function getfk_user_id() {
        return $this->fk_user_id;
    }
    
    public function getfk_category_id() {
        return $this->fk_user_id;
    }
    
    public static function checkLogin($fk_user_id, $fk_category_id) {
        $sql = 'SELECT * FROM tb_user_interests WHERE fk_category_id=? AND fk_user_id=?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($fk_user_id, $fk_category_id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        return $query->fetch();
    }
}

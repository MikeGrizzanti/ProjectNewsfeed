<?php

class tb_source {
    private $source_id = 0;
    private $source_name = "";
    private $source_path = "";


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
    
    public function getSourceId() {
        return $this->source_id;
    }
    
    public function getSourceName() {
        return $this->source_name;
    }
    
    public function getSourcePath() {
        return $this->source_path;
    }
    
    public function setSourceName($source_name) {
        $this->source_name = $source_name;
    }
    
    public function setSourcePath($source_path) {
        $this->source_path = $source_path;
    }
    
    public static function getNameFromSource() {
        $sql = 'SELECT source_name FROM tb_source;';
        $query = DB::getDB()->prepare($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
        return $query->fetchAll();
    }
<<<<<<< HEAD
    
    public static function checkIfSourceExists($source_path) {
        $sql = "SELECT source_path FROM tb_source WHERE source_path = '?';";
        $query = DB::getDB()->prepare($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
        return $query->fetch();
    }
    
}
    
    
=======
}
>>>>>>> 57a0b2ed3f8295f4473027b5d57d2eb93701ea11

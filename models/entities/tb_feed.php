<?php

class tb_feed {
    private $feed_id = 0;
    private $feed_title = "";
    private $feed_content = "";
    private $feed_img_path = "";
    private $fk_category_id = 0;
    private $fk_feed_groupChat_id = 0;
    
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
    
    public function get_feed_id() {
        return $this->category_id;
    }
    
    public function get_feed_title() {
        return $this->feed_title;
    }
    
    public function get_feed_content() {
        return $this->feed_content;
    }
    
    public function get_feed_img_path() {
        return $this->feed_img_path;
    }
    
    public function get_fk_category_id() {
        return $this->fk_category_id;
    }
    
    public function get_fk_feed_groupChat_id() {
        return $this->fk_feed_groupChat_id;
    }
    
    public function set_feed_title ($feed_title) {
        $this->feed_title = $feed_title;
    }
    
    public function set_feed_content ($feed_content) {
        $this->feed_content = $feed_content;
    }
    
    public function set_feed_img_path($feed_img_path) {
        $this->feed_img_path = $feed_img_path;
    }
    
    public static function getFeedFromID ($id) {
        $sql = 'SELECT * FROM tb_feed WHERE feed_id = ?';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_feed');
        return $query->fetch();
    }
    
    
}


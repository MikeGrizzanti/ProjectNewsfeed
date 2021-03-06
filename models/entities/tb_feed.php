<?php

class tb_feed {
    private $feed_id = 0;
    private $feed_title = "";
    private $feed_author = "";
    private $feed_pubdate = "";
    private $feed_guid = "";
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
    
    public function get_feed_author() {
        return $this->feed_author;
    }
    
    public function get_feed_pubDate() {
        return $this->feed_pubdate;
    }
    
    public function get_feed_guid() {
        return $this->feed_guid;
    }

    public function get_feed_img_path() {
        return $this->feed_img_path;
    }
    
    public function get_fk_category_id() {
        return $this->fk_category_id;
    }
    
    public function get_fk_feed_groupchat_id() {
        return $this->fk_feed_groupchat_id;
    }
    
    public function set_feed_title($feed_title) {
        $this->feed_title = $feed_title;
    }
    
    public function set_feed_author($feed_author) {
        $this->feed_author = $feed_author;
    }
    
    public function set_feed_pubDate($feed_pubDate) {
        $this->feed_pubdate = $feed_pubDate;
    }
    
    public function set_feed_guid($feed_guid) {
        $this->feed_guid = $feed_guid;
    }

    public function set_feed_content($feed_content) {
        $this->feed_content = $feed_content;
    }
    
    public function set_feed_img_path($feed_img_path) {
        $this->feed_img_path = $feed_img_path;
    }
    
    public static function getFeedFromID ($id) {
        $sql = 'SELECT * FROM tb_feed WHERE feed_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_feed');
        return $query->fetch();
    }
    
    public static function getAllFeedSources() {
        $sql = 'SELECT fk_source_id FROM tb_feed';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($feed_source));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_feed');
        return $query->fetchAll();
    }
    
    //
    
    public static function getAllFeedsFromSourceId ($source) {
        $sql = "SELECT * FROM tb_feed WHERE fk_source_id = ?;";
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($source->getSourceId()));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
        return $query->fetchAll();
    }
    
    public static function getFeedFromSourceIds ($user_id) {
        $sources = tb_source::getSourceFromUserID ($user_id);
        $feeds = array();
        foreach ($sources as $source) {
            $feeds[] = tb_feed::getAllFeedsFromSourceId($source);            
        }
        
        echo json_encode(array_values($feeds));

    }
    
    //
    
    
    public static function getAllFeedsFromFilterSourceId ($source_name) {   
        $sql = "SELECT * FROM tb_feed WHERE fk_source_id IN (
                    SELECT source_id
                    FROM tb_source
                    WHERE source_name LIKE :source_name
                );";
        $query = DB::getDB()->prepare($sql);
        $query->execute(array(':source_name' => $source_name));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
        return $query->fetchAll();
    }
    
    public static function getFeedFromDFilterSourceIds ($user_id, $source_filter) {
        $sources = tb_source::getSourceFromUserID ($user_id);
        $feeds = array();
        $feeds[] = tb_feed::getAllFeedsFromFilterSourceId($source_filter);            
        
        
        echo json_encode(array_values($feeds));

    }
    
    //
    
    public static function getAllFeedsFromSourceIdAndCategoryId ($source, $category) {
        $sql = "SELECT * FROM tb_feed WHERE fk_source_id = ? AND fk_category_id = ?;";
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($source->getSourceId(), intval($category)));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
        return $query->fetchAll();
    }
    
    public static function getFeedFromSourceIdsAndCategoryIds ($user_id, $category) {
        $sources = tb_source::getSourceFromUserID ($user_id);
        $feeds = array();
        foreach ($sources as $source) {
            $feeds[] = tb_feed::getAllFeedsFromSourceIdAndCategoryId($source, $category);            
        }
        
        echo json_encode(array_values($feeds));

    }

}


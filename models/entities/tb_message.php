<?php

class tb_message {
    private $message_id = 0;
    private $message_timestamp = "";
    private $message_text = "";
    private $fk_message_user_id = 0;
    private $fk_groupChat_id = 0;
    
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
    
    public static function get_message_id() {
        return $this->message_id;
    }
    
    public static function get_message_timestamp() {
        return $this->message_timestamp;
    }
    
    public static function get_message_text() {
        return $this->message_text;
    }
    
    public static function get_fk_message_user_id() {
        return $this->fk_message_user_id;
    }
    
    public static function  get_fk_groupChat_id() {
        return $this->fk_groupChat_id;
    }
    
    public function set_message_timestamp ($message_timestamp) {
        $this->message_timestamp = $message_timestamp;
    }
    
    public function set_message_text ($message_text) {
        $this->message_text = $message_text;
    }
    
    public static function getMessageFromGroupChat($fk_message_user_id, $fk_groupChat_id) {
        $sql = 'SELECT message_id FROM tb_message WHERE fk_message_user_id = ? AND fk_groupChat_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query -> execute (array($fk_message_user_id, $fk_groupChat_id));
        $query -> setFetchMode(PDO::FETCH_CLASS, 'tb_message');
        return $query->fetch();
    }
    
    public static function saveMessage($message_timestamp, $fk_message_user_id, $message_text, $fk_groupChat_id) {
        $sql = 'INSERT INTO tb_message (message_timestamp, fk_message_user_id, message_text, fk_groupChat_id) VALUES (?,?,?) WHERE fk_groupChat_id = ?';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($message_timestamp, $fk_message_user_id, $message_text, $fk_groupChat_id));
    }
}


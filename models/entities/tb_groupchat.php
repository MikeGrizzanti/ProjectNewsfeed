<?php

class tb_groupChat {
    private $groupchat_id = 0;
    private $groupchat_name = "";
    private $groupchat_timestamp = "";
    private $groupchat_maxPartecipants = 6;
    
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
    
    public function get_groupChat_id () {
        return $this->groupchat_id;
    }
    
    public function get_groupChat_name () {
        return $this->groupchat_name;
    }
    
    public function get_groupChat_timestamp() {
        return $this->groupchat_timestamp;
    }
    
    public function get_groupChat_maxPartecipants() {
        return $this->groupchat_maxPartecipants;
    }
    
    public function set_groupChat_name($groupChat_name) {
        if (strlen($groupChat_name) <= 255)
            $this->groupchat_name = $groupChat_name;
    }
    
    public function set_groupChat_timestamp($groupChat_timestamp) {
        $this->groupchat_timestamp = $groupChat_timestamp;
    }
    
    public function getGroupChatFromId($id) {
        $sql = 'SELECT * FROM tb_groupchat WHERE id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_groupchat');
        return $query->fetch();
    }
}


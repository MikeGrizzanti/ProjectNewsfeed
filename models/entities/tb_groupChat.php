<?php

class tb_groupChat {
    private $groupChat_id = 0;
    private $groupChat_name = "";
    private $grouChat_timestamp = "";
    private $groupChat_maxPartecipants = 6;
    
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
        return $this->groupChat_id;
    }
    
    public function get_groupChat_name () {
        return $this->groupChat_name;
    }
    
    public function get_groupChat_timestamp() {
        return $this->groupChat_timestamp;
    }
    
    public function get_groupChat_maxPartecipants() {
        return $this->groupChat_maxPartecipants;
    }
    
    public function set_groupChat_name($groupChat_name) {
        if (strlen($groupChat_name) <= 255)
            $this->groupChat_name = $groupChat_name;
    }
    
    public function set_groupChat_timestamp($groupChat_timestamp) {
        $this->grouChat_timestamp = $groupChat_timestamp;
    }
    
    public function getGroupChatFromId($id) {
        $sql = 'SELECT * FROM tb_groupChat WHERE id = ?';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_groupChat');
        return $query->fetch();
    }
}


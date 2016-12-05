<?php

class tb_groupChatPartecipants {
    private $fk_group_chat_id = 0;
    private $fk_gcp_user_id = 0;
    
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
    
    public function get_fk_group_chat_id() {
        return $this->fk_group_chat_id;
    }
    
    public function get_fk_gcp_user_id() {
        return $this->fk_gcp_user_id;
    }
    
    public static function getPartecipantsFromGroupChat($fk_group_chat_id) {
        $sql    = 'SELECT fk_gcp_user_id FROM tb_groupChatPartecipants WHERE tb_group_chat_id = ?';
        $query  = DB::getDB()->prepare($sql);
        $query -> execute(array($fk_group_chat_id));
        $query -> setFetchMode(PDO::FETCH_CLASS, 'tb_groupChatPartecipants');
        return $query->fetch();
    }
}


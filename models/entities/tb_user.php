<?php

class tb_user {
    private $user_id = 0;
    private $user_firstName = '';
    private $user_lastName = '';
    private $user_nickName = '';
    private $user_password = '';
    private $user_eMail = '';
    
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
    
    public function getId() {
        return $this->user_id;
    }
    
    public function getFirstName() {
        return $this->user_firstName;
    }
    
    public function getLastName() {
        return $this->user_lastName;
    }
    
    public function getNickName() {
        return $this->user_nickName;
    }
    
    public function getPassword() {
        return $this->user_password;
    }
    
    public function getEmail() {
        return $this->user_eMail;
    }
    
    public function setFirstName($firstName) {
        if (strlen($firstName) <= 50) 
            $this->user_firstName = $firstName;
    }
    
    public function setLastName($lastName) {
        if (strlen($lastName) <= 50) 
            $this->user_lastName = $lastName;
    }
    
    public function setNickName($nickName) {
        if (strlen($nickName) <= 50) 
            $this->user_nickName = $nickName;
    }
    
    public function setPassword($password) {
        $this->user_password = $password;
    }
    
    public function setEmail($email) {
        $this->user_eMail = $email;
    }
    
    public static function checkLogin($nickName, $password) {
        $sql = 'SELECT * FROM tb_user WHERE user_nickName=?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($nickName));
        
        if ($query->rowCount() > 0) {
            $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
            $user = $query->fetch();
            if (password_verify($password, $user->getPassword())) {
                return $user;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }
    
    public static function getUserFromId($id) {
        $sql = 'SELECT * FROM tb_user WHERE user_id=?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        return $query->fetch();
    }
    
    public static function getUserIdFromCategory($user_id) {
        $sql = 'SELECT tb_user.user_id, tb_user.user_firstName, tb_user.user_lastName, tb_user.user_nickName, tb_user.user_password, tb_user.user_eMail FROM tb_user INNER JOIN tb_user_interests ON (tb_user.user_id = tb_user_interests.fk_user_id) WHERE tb_user_interests.fk_interests_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array(id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        return $query->fetchAll();
    }
    
    public static function getUserIdFromMessageID ($message_id) {
        $sql = 'SELECT tb_message.message_id FROM tb_message INNER JOIN tb_user ON (tb_message.fk_message_user_id = tb_user.user_id);';
    }


    public static function saveUser($id, $firstName, $lastName, $nickName, $password, $eMail) {
        if (is_null($id)) {
            return self::createUser($firstName, $lastName, $nickName, $password, $eMail);
        } else {
            self::updateUser($firstName, $lastName, $nickName, $password, $eMail, $id);
        }
    }
    
    private static function updateUser($firstName, $lastName, $nickName, $password, $eMail, $id) {
        $sqlcheck = 'SELECT * FROM tb_user WHERE user_id = ?';
        $queryCheck = DB::getDB()->prepare($sqlcheck);
        $queryCheck->execute(array($firstName, $lastName, $nickName, $password, $eMail, $id));
        
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'UPDATE tb_user SET = user_firstName = ?, user_lastName = ?, user_nickName = ?, user_password = ?, user_eMail = ? WHERE user_id = ?';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($firstName, $lastName, $nickName, $passwordHashed, $eMail, $id));
    }
    
    /*private static function checkIfÚnique ($nickName, $eMail) {
        $sqlcheck = 'SELECT * FROM tb_user where user_nickName = ? AND user_eMail = ?;';
        $queryCheck = DB::getDB()->prepare($sqlcheck);
        $queryCheck->execute(array($nickName,$eMail));
        
        var_dump($queryCheck);
    }*/

    private static function createUser($firstName, $lastName, $nickName, $password, $eMail) {
        $sqlcheck = "SELECT * FROM tb_user where user_nickName = ? AND user_eMail = ?;";
        $queryCheck = DB::getDB()->prepare($sqlcheck);
        $queryCheck->execute(array($nickName,$eMail));
        
        if($queryCheck->rowCount() > 0) {
            return NULL;
        } else {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO tb_user (user_firstName, user_lastName, user_nickName, user_password, user_eMail) VALUES (?,?,?,?,?);';
            $query = DB::getDB()->prepare($sql);
            $query->execute(array($firstName, $lastName, $nickName, $passwordHashed, $eMail));
            
            $sql2 = 'SELECT * FROM tb_user WHERE user_nickName = ?;';
            $query2 = DB::getDB()->prepare($sql2);
            $query2->execute(array($nickName));
            $query2->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
            return $query2->fetch();
        }
    }
}


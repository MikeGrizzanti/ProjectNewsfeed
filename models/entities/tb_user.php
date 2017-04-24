<?php

class tb_user {
    private $user_id = 0;
    private $user_firstname = '';
    private $user_lastname = '';
    private $user_nickname = '';
    private $user_password = '';
    private $user_email = '';
    private $user_status = '';
    
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
        return $this->user_firstname;
    }
    
    public function getLastName() {
        return $this->user_lastname;
    }
    
    public function getNickName() {
        return $this->user_nickname;
    }
    
    public function getPassword() {
        return $this->user_password;
    }
    
    public function getEmail() {
        return $this->user_email;
    }
    
    public function getStatus() {
        return $this->user_status;
    }

    public function setFirstName($firstName) {
        if (strlen($firstName) <= 50) 
            $this->user_firstname = $firstName;
    }
    
    public function setLastName($lastName) {
        if (strlen($lastName) <= 50) 
            $this->user_lastname = $lastName;
    }
    
    public function setNickName($nickName) {
        if (strlen($nickName) <= 50) 
            $this->user_nickname = $nickName;
    }
    
    public function setPassword($password) {
        $this->user_password = $password;
    }
    
    public function setEmail($email) {
        $this->user_email = $email;
    }
    
    public function setStatus ($status) {
        $this->user_status = $status;
    }


    public static function checkLogin($nickName, $password) {
        $sql = 'SELECT * FROM tb_user WHERE user_nickname=?;';
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
        $sql = 'SELECT tb_user.user_id, tb_user.user_firstname, tb_user.user_lastname, tb_user.user_nickname, tb_user.user_password, tb_user.user_email FROM tb_user INNER JOIN tb_user_interests ON (tb_user.user_id = tb_user_interests.fk_user_id) WHERE tb_user_interests.fk_interests_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($user_id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        return $query->fetchAll();
    }
    
    public static function getUserIdFromMessageID ($message_id) {
        $sql = 'SELECT tb_message.message_id FROM tb_message INNER JOIN tb_user ON (tb_message.fk_message_user_id = tb_user.user_id);';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($message_id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_message');
        return $query->fetchAll();
        
    }

    public static function saveUser($id, $firstName, $lastName, $nickName, $password, $eMail) {
        if (is_null($id)) {
            return self::createUser($firstName, $lastName, $nickName, $password, $eMail);
        } else {
            self::updateUser($firstName, $lastName, $nickName, $password, $eMail, $id);
        }
    }
    
    public static function setStatusToZero($id) {
        $sql = 'UPDATE tb_user SET user_status = 0 WHERE user_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
    }
    
    public static function update_user_status($newStatus, $id) {
        $sql = "UPDATE tb_user SET user_status = ? WHERE user_id = ?";
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($newStatus, $id));
    }

    private static function updateUser($firstName, $lastName, $nickName, $password, $eMail, $id) {
        $sqlcheck = 'SELECT * FROM tb_user WHERE user_id = ?';
        $queryCheck = DB::getDB()->prepare($sqlcheck);
        $queryCheck->execute(array($firstName, $lastName, $nickName, $password, $eMail, $id));
        
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'UPDATE tb_user SET user_firstname = ?, user_lastname = ?, user_nickname = ?, user_password = ?, user_email = ? WHERE user_id = ?';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($firstName, $lastName, $nickName, $passwordHashed, $eMail, $id));
    }
    
    public static function getUserIdFromEmail ($email) {
        $sql = 'SELECT user_id FROM tb_user WHERE user_email = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($email));
    }


    /*private static function checkIfÚnique ($nickName, $eMail) {
        $sqlcheck = 'SELECT * FROM tb_user where user_nickName = ? AND user_eMail = ?;';
        $queryCheck = DB::getDB()->prepare($sqlcheck);
        $queryCheck->execute(array($nickName,$eMail));
        
        var_dump($queryCheck);
    }*/

    private static function createUser($firstName, $lastName, $nickName, $password, $eMail) {
        $sqlcheck = "SELECT * FROM tb_user where user_nickname = ? AND user_email = ?;";
        $queryCheck = DB::getDB()->prepare($sqlcheck);
        $queryCheck->execute(array($nickName,$eMail));
        
        if($queryCheck->rowCount() > 0) {
            return NULL;
        } else {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO tb_user (user_firstname, user_lastname, user_nickname, user_password, user_email) VALUES (?,?,?,?,?);';
            $query = DB::getDB()->prepare($sql);
            $query->execute(array($firstName, $lastName, $nickName, $passwordHashed, $eMail));
            
            $sql2 = 'SELECT * FROM tb_user WHERE user_nickname = ?;';
            $query2 = DB::getDB()->prepare($sql2);
            $query2->execute(array($nickName));
            $query2->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
            return $query2->fetch();
        }
    }
    
    public static function getOldPw($id) {
        $sql = 'SELECT user_password FROM tb_user WHERE user_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        $user = $query->fetch();
        return $user->getPassword();
    }
    
    public static function getOldEmail($id) {
        $sql = 'SELECT user_email FROM tb_user WHERE user_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        $user = $query->fetch();
        return $user->getEmail();
    }
    
    public static function changePassword($newPasswordHashed, $id) {
        $sql = 'UPDATE tb_user SET user_password = ? WHERE user_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($newPasswordHashed, $id));
    }
    
    public static function changeEmail($email, $id) {
        $sql = 'UPDATE tb_user SET user_email = ? WHERE USER_id = ?;';
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($email, $id));
    }
    
    public static function getnewEmail($id) {
        $sql = "SELECT user_email FROM tb_user WHERE user_id = ?;";
        $query = DB::getDB()->prepare($sql);
        $query->execute(array($id));
        $query->setFetchMode(PDO::FETCH_CLASS, 'tb_user');
        return $query->fetch();
    }
}


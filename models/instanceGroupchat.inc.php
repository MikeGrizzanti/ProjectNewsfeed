<?php
require_once 'models/entities/tb_groupchat.php';

if (isset($_POST)){
    $data = trim($_POST['data']);
    tb_groupchat::createInstance($data);


    echo json_encode("here");

}



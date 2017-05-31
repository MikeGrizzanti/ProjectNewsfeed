<?php
require_once 'models/entities/tb_groupchat.php';

$data = trim($_POST['newsCardId']);
tb_groupchat::createInstance($data);






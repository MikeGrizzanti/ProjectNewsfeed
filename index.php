<?php

require_once 'models/entities/db.php';
require_once 'models/entities/tb_category.php';
require_once 'models/entities/tb_feed.php';
require_once 'models/entities/tb_groupchat.php';
require_once 'models/entities/tb_groupchatpartecipants.php';
require_once 'models/entities/tb_message.php';
require_once 'models/entities/tb_source.php';
require_once 'models/entities/tb_user.php';
//require_once 'models/download_feed.inc.php';
require_once 'models/phpmailer.php';

require_once 'controller/controller.php';

$action = isset($_GET['action'])?$_GET['action']:'login';
$controller = new controller();


if(isset($_GET["loadObject"])){
   
    $var = $controller->print_feeds();
    exit;
}

if(isset($_GET["loadObjectCategory"])){
    
    $var = $controller->filter_category($_GET["loadObjectCategory"]);
    exit;
}

if(isset($_GET["loadObjectSource"])){
    
    $var = $controller->filter_source($_GET["loadObjectSource"]);
    exit;
}


if (method_exists($controller, $action)) {
    $controller->run($action);
}

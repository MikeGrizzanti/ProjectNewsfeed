<?php

require_once 'models/entites/db.php';
require_once 'models/entites/tb_category.php';
require_once 'models/entites/tb_feed.php';
require_once 'models/entites/tb_groupChat.php';
require_once 'models/entites/tb_groupChatPartecipants.php';
require_once 'models/entites/tb_message.php';
require_once 'models/entites/tb_user.php';
require_once 'models/entites/tb_user_interests.php';

require_once 'controller/controller.php';

$action = isset($_GET['action'])?$_GET['action']:'login';
$controller = new controller();

if (method_exists($controller, $action)) {
    $controller->run($action);
}

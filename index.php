<?php

require_once 'models/entities/db.php';
require_once 'models/entities/tb_category.php';
require_once 'models/entities/tb_feed.php';
require_once 'models/entities/tb_groupChat.php';
require_once 'models/entities/tb_groupChatPartecipants.php';
require_once 'models/entities/tb_message.php';
require_once 'models/entities/tb_source.php';
require_once 'models/entities/tb_user.php';
require_once 'models/entities/tb_user_interests.php';
require_once 'models/download_feed.inc.php';
require_once 'models/phpmailer.php';

require_once 'controller/controller.php';

$action = isset($_GET['action'])?$_GET['action']:'main';
$controller = new controller();

if (method_exists($controller, $action)) {
    $controller->run($action);
}

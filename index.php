<?php

//require_once('inc/projectParams.php');
require_once('inc/autoload.php');



//$router = new Router($_GET['screen'],$_GET['controller'],$_GET['action']);
$router = new Router($_GET['screen'],$_GET['controller'],$_GET['action']);
$router->go();



?>

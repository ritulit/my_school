<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
require_once('inc/projectParams.php');
spl_autoload_register(function($class_name) {


   if(strpos($class_name, 'Model') ) {

        $path = sprintf('mvc/models/%s.php', $class_name);
    }
    elseif(strpos($class_name, 'Controller') ) {
        $path = sprintf('mvc/controllers/%s.php', $class_name);
      }
    else{
      $path = sprintf('inc/%s.php', $class_name);
    }



    include_once($path);


  });

$instance = MyPortalDB::getInstance();
$_myDB = $instance->getConnection();
$utilities = Utilities::getInstance();







?>

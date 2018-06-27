<?php
class AdministrationController{
    public $data =Array();
    private $sub_controller;
    private $sub_action;

  public function administrationAction($args){

   $managers = new ManagersController();

   $m_arr = $managers->listAllThumbnailAction();

   $managers_count = $managers->countAllAction('managers','is_deleted',"0");



   $sub_controller = new $args[0]();
   $sub_action = $args[1];
   $callable_param = [$sub_controller, $sub_action];


  if( !is_callable($callable_param,$sub_action) ) {

   $_POST['Main_container_view_fail'] = false;

  }


  $dynamic_view = call_user_func_array($callable_param,[]);
   $view_name = str_replace("Action", "View", $sub_action) ;
   $_POST['main_container_view']= $view_name;
   $data['dynamic_view'] = $dynamic_view;
   $data['managers_list']=$m_arr;

   $data['managers_count']=$managers_count;


   View::render('administrationView',$data);








     }

  }


 ?>

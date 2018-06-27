<?php
class AuthController{
  public $data =Array();
  private $sub_controller;
  private $sub_action;

public function authAction($args){
  //$login = new LoginController();

  $prefix = strtolower(str_replace("Controller", "", $args[0])) ;
  $sub_controller = new $args[0]();
  $sub_action = $prefix.$args[1];
  //$sub_action = strtolower(str_replace("Controller","",$args[0]));


  $callable_param = [$sub_controller, $sub_action];
  //var_dump ($callable_param);


  if( !is_callable($callable_param,$sub_action) ) {

  $_POST['auth_view_fail'] = false;
}
// here we call the right function that will return the content of the auth view - login or logout view
  $dynamic_view = call_user_func_array($callable_param,[]);
  $view_name = str_replace("Action", "View", $sub_action) ;

  // $view_name = $sub_action."View" ;
   $_POST['auth_container_view']= $view_name;
   $data['dynamic_view'] = $dynamic_view;

   View::render('authView',$data);







}




}

?>

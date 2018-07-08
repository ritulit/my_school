<?php
require_once('inc/autoload.php');
class Router {
    //route requests to appropriate controllers
    //We agreed on this structure: /$controller/$action/

    public $screen, $controller, $action, $screen_action_name;
    private $callable_param;



    public function __construct($screen_from_url,$controller_from_url,$action_from_url) {

            //  if( !isset($screen_from_url) ){
                    $screen_from_url = $_GET['screen'];
              //      echo "screen is  ".$screen_from_url."<br>";
            //  }

              //  if( !isset($controller_from_url) ){
                    $controller_from_url = $_GET['controller'];
              //      echo "controller is  ".$controller_from_url."<br>";
            //    }
                if( !isset($action_from_url) ){
                    $action_from_url = $_GET['action'];
                //    echo "action is  ".$action_from_url."<br>";

                }
                $this->screen =$screen_from_url;
                $this->screen_action_name = strtolower($screen_from_url).'Action';
              //  echo "this screen is ".$this->screen;
                $this->controller = $controller_from_url;
               //echo "this controller is ".$this->controller;
                $this->action = $action_from_url;
               //echo "this action is ".$this->action;
              // echo "this screen action is ".$this->screen_action_name;

}

    private function normalize_name($name, $type) {
        //type = action/controller
        //name = name of the component

        if($type=='screen'){

        return ucfirst(strtolower($name)) . 'Controller';
        }

        if($type=='action') {

            return $name . 'Action';

        }

        if($type=='controller'){

            return ucfirst(strtolower($name)) . 'Controller';
        }
    }

    public function go() {

        $screen_name        = $this->normalize_name($this->screen, 'screen');
      //  echo "screen name is  ".  $screen_name ."<br>";

        $controller_name    = $this->normalize_name($this->controller, 'controller');
      //  echo "controller name is  ".  $controller_name ."<br>";

        $action_name        = $this->normalize_name($this->action, 'action');
      //  echo "action name is  ". $action_name  ."<br>";

        // if(!file_exists('mvc/views/'.$screen_name.'View.php')){
        //   echo "screen file not found";
        //   View::render('notFound',4);
        //   die();
        // }

        if($controller_name=="Controller"){
        $controller_name=ucfirst($this->screen)."Controller";
        }

        if( !class_exists($controller_name ) ) {
          View::render('notFound',4);

        //die();
        }

      //todo: add validation for method exist (but maybe move it to the screen controller)
          ////////////////////////////
        $screen_instance = new $screen_name();

        // if($action_name=="Action"){
        // $action_name=$this->screen_action_name;
        // $callable_param = [$screen_instance, $action_name];
        // }
       $callable_param = [$screen_instance, $this->screen_action_name];


        if( !is_callable($callable_param) ) {

         View::render('somethingWentWrong',4);

        }




        $arr = Array();
        $arr[0]=$controller_name;
        $arr[1]=$action_name;






        call_user_func($callable_param, $arr);

    }


}

<?php
require_once('inc/autoload.php');
class Router {
    //route requests to appropriate controllers
    //We agreed on this structure: /$controller/$action/

    private  $controller, $action;


    public function __construct(

                $controller_from_url,
                $action_from_url
            ) {


                if( !isset($controller_from_url) ){
                    $controller_from_url = $_GET['controller'];
                    echo "controller is  ".$controller_from_url."<br>";
                }
                if( !isset($action_from_url) ){
                    $action_from_url = $_GET['action'];
                    echo "action is  ".$action_from_url."<br>";

                }

                $this->controller = $controller_from_url;
                $this->action = $action_from_url;

    }

    private function normalize_name($name, $type) {
        //type = action/controller
        //name = name of the component



        if($type=='action') {

            return strtolower($name) . 'Action';

        }

        if($type=='controller'){

            return ucfirst(strtolower($name)) . 'Controller';
        }
    }

    public function go() {


        $controller_name    = $this->normalize_name($this->controller, 'controller');
        echo "controller name is  ".  $controller_name ."<br>";

        $action_name        = $this->normalize_name($this->action, 'action');
        echo "action name is  ". $action_name  ."<br>";



        if($controller_name=="Controller"){
        $controller_name=ucfirst($this->screen)."Controller";
        }

        if( !class_exists($controller_name ) ) {
          echo "controller file not found";

        die();
        }

        $controller_instance = new $controller_name();

        if($action_name=="Action"){
        $action_name=$this->controller."Action";

        }
        $callable_param = [$controller_instance, $action_name];


        if( !is_callable($callable_param) ) {

         View::render('somethingWentWrong',4);

        }

        call_user_func_array($callable_param, []);

    }


}

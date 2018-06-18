<?php
class HomeController{
    public $data =Array();
    private $sub_controller;
    private $sub_action;
//get the $args array that containd the inner class and method the screen controller should run
  public function homeAction($args){

   

//  if($args['controller']!=null){
    $sub_controller = new $args[0]();
    $sub_action = $args[1];
  //}

    echo "this is the sub action: ".$sub_action;


   $courses = new CoursesController();
   $arr = $courses->listAllThumbnailAction();
   $course_count = $courses->countAllAction('courses');


  $callable_param = [$sub_controller, $sub_action];


  if( !is_callable($callable_param,$sub_action) ) {

   $_POST['Main_container_view_fail'] = false;
  // View::render('somethingWentWrong',4);

  }


  call_user_func_array($callable_param,[]);
   $view_name = str_replace("Action", "View", $sub_action) ;
   $_POST['main_container_view']= $view_name;

   $data['course_list']=$arr;
   $data['courses_count']=$course_count;

   print_r($_POST);
   View::render('homeView',$data);








     }

  }


 ?>

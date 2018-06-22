<?php
class HomeController{
    public $data =Array();
    private $sub_controller;
    private $sub_action;
   //get the $args array that containd the inner class and method the screen controller should run
  public function homeAction($args){

   $courses = new CoursesController();
   $students = new StudentsController();
   $c_arr = $courses->listAllThumbnailAction();
   $s_arr = $students->listAllThumbnailAction();
   $course_count = $courses->countAllAction('courses','is_deleted',"0");
   $students_count = $students->countAllAction('students','is_deleted',"0");


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
   $data['course_list']=$c_arr;
   $data['students_list']=$s_arr;
   $data['courses_count']=$course_count;
   $data['students_count']=$students_count;


   View::render('homeView',$data);








     }

  }


 ?>

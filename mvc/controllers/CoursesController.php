<?php

class CoursesController {

private $course_name, $course_number, $course_description, $course_filename;

public function listAllAction() {

       $model = new CoursesModel();

     $list = $model->get_all_courses();


    return $list;
   }

public function listAllThumbnailAction() {
        //preparing the courses list
        $model = new CoursesModel();

        $list = $model->get_all_courses();
        //preparing ony an arrays of the thumbnail data
        $thumbnails_arr = Array();
        foreach($list as $value){array_push($thumbnails_arr ,array('name'=>$value['name'],'img'=>$value['img'],'id'=>$value['id']));}
        //assigning paths to the courses images
        foreach($thumbnails_arr as &$value){
        if(array_key_exists('img', $value) && (is_null($value['img'])|| $value['img']==="")){$value['img']=COURSE_DEFAULT_IMAGE;}
        else{$value['img']=COURSE_IMAGE_UPLOADS.$value['img'];}
        }

        return $thumbnails_arr;


   }

public function courseDetailsAction(){
     $model = new CoursesModel();
     $mydata = Array();
     $mydata  =   $model->get_course('id',$_GET['id']);
     //print_r($mydata);
     return $mydata;

    // }


     //Get back associative array of a single user

     //prepare array for display and pass it over to the view

     //echo view / render view
    //  View::render('courseDetailsView',$data);

   }

public function courseRegisterAction() {
    $utilities = new Utilities();
    $model = new CoursesModel();
    $data = Array();
    $name=false;
    $number=false;
    $description=false;
    $filename = null;
    $errors= Array();

      if(isset($_POST['submitted'])){
        $name = $this->evaluateCourseName($_POST['course_name']);
        $number = $this->evaluateCourseNumber($_POST['course_number']);
        $description = $this->evaluateCourseDesc(trim($_POST['course_description']));
        if(isset($_FILES['course_image']) && $_FILES['course_image']['error'] == 0 ){
            $filename = $this->evaluateCourseImage($_FILES['course_image']['type']);
          }

        if(!$name || !$number || !$description || $filename==false){
          if($name==false){$errors['course_name']="course name is invalid. minimum 1 char <br>";}//{echo "course name is invalid. minimum 1 char <br>";}
          if($number==false){$errors['course_number_invalid']="course number is invalid.<br>";}//{echo "course number is invalid.<br>";}
          if($description==false){$errors['course_description']="course description is invalid . minimum 1 char .<br>";}//{echo  "course description is invalid . minimum 1 char .<br>";}
          if(isset($_FILES['course_image']) && $filename===false){$errors['file_type']="file type is not adquate. please upload only images<br>";}//{echo "file type is not adquate. please upload only images<br>";}
          elseif(isset($_FILES['course_image']) && ($_FILES['course_image']['name'] !="") && ($_FILES['course_image']['error'] != 0) ){$errors['file_general']="something is wrong with the file. plese try again or replace it.";}//{echo "something is wrong with the file. plese try again or replace it.";}
          $data=$errors;
            $_POST['success']="false";
          //  header('location: courseRegister');
          header("url=/home/courses/courseRegister");

          //  return false;


        }

        if( $name && $number && $description && $filename==false){
          $this->course_name = $_POST['course_name'];
          $this->course_number = $_POST['course_number'];
          $this->course_descriptin = trim($_POST['course_description']);
          $model->create_course($this->course_name,$this->course_number, $this->course_description, $filename=null);
            header("location: /home/");
            $_POST['success']="true";
          //  return true;

        }

        if($name && $number && $description && $filename){
          $this->course_name = $_POST['course_name'];
          $this->course_number = $_POST['course_number'];
          $this->course_description = trim($_POST['course_description']);
          $filename =  $utilities->imageUpload('course_image', COURSE_IMAGE_UPLOADS, $this->course_number);
          $this->course_filename = $filename;
          $model->create_course($this->course_name,$this->course_number, $this->course_description,   $this->course_filename);
          header("location: /home/");
          $_POST['success']="true";
        }






      }
      return $data;

   }

public function editCourseAction(){

     //allow editing of course xmlrpc_parse_method_description
     //allow editing of course name
    //allow replacing the course image

}

public function deleteCourseAction($id){
  $utilities = new Utilities();
  $model = new CoursesModel();



  //delete course from courses2student
  // remove the joining of the course with students
  //remove the course inage from images folder



}

public function countAllAction($courses){
  $model = new CoursesModel();
  $data =   $model->count_group($courses);
  return $data;

}

   //evaluating the name is minimum 1 word
private function evaluateCourseName($name){
      $regex = "^\w+( \w+)*$";
      if(!preg_match("/$regex/",$name)){return false;}
      else{return true;}
      }
     //valisation for numeric value of up to 6 digits
private function evaluateCourseNumber($number){
      $model = new CoursesModel();
      $res= $model->get_course("course_number",$number);
      if(empty($res)){
        $regex = "^[1-9]{1}[0-9]{3,5}$";
        if(!preg_match("/$regex/", $number)){
            $errors[course_number]="course number should be 4-6 digits.";
          //echo "course nuber should be 4-6 digits.";
          return false;}
        else{return true;}}
      if(!empty($res)){
        $errors[course_number_unique]="course number already exists. should be unique.";
        //echo "course number already exists. should be unique.";
        return false;}



     }
      //evaluating the description is minimum 1 word
private function evaluateCourseDesc($description){
       $regex = "^[a-zA-Z0-9\-\_\/\s,.]+$";
       if(!preg_match("/$regex/",$description)){return false;}
       else{return true;}

        }
     //evaluating the uploaded file type is image
private function evaluateCourseImage($imageType){
     if(substr($imageType, 0, 5) !== "image"){return false;}
     else{return true;}

}



}
 ?>

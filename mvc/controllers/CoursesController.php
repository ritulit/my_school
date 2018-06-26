<?php

class CoursesController {

private $course_name, $course_number, $course_description, $course_filename;
 public $errors = Array();


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
        foreach($list as $value){
          if($value['is_deleted']==0){
            array_push($thumbnails_arr ,array('name'=>$value['name'],'img'=>$value['img'],'id'=>$value['id']));
          }
        }
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
     return $mydata;

   }

public function courseRegisterAction() {
    global $utilities;
    $model = new CoursesModel();

      if(isset($_POST['submitted'])){
        $name = $this->evaluateCourseName($_POST['course_name']);
        $number = $this->evaluateCourseNumber($_POST['course_number']);
        $description = $this->evaluateCourseDesc(trim($_POST['course_description']));
        if(isset($_FILES['course_image']) && $_FILES['course_image']['error'] == 0 ){
            $filename = $utilities->evaluateImageType($_FILES['course_image']['type']);
          }

        if(!$name || !$number || !$description || $filename==false){

          if(isset($_FILES['course_image']) && $filename===false){$this->errors['file_type']=$utilities->createUserMessage("file_type");}
          elseif(isset($_FILES['course_image']) && ($_FILES['course_image']['name'] !="") && ($_FILES['course_image']['error'] != 0) ){$this->errors['file_general']=$utilities->createUserMessage("file_general");}

          $_POST['success']="false";
          $_POST['course_register_errors']=$this->errors;
          header("url=/home/courses/courseRegister");

        }

        if( $name && $number && $description && $filename==false){
          $this->course_name = $_POST['course_name'];
          $this->course_number = $_POST['course_number'];
          $this->course_description = trim($_POST['course_description']);
          $model->create_course($this->course_name,$this->course_number, $this->course_description, $filename=null);
            header("location: /home/");
            $_POST['success']="true";

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

   }

  public function courseEditAction(){
    global $utilities;
    $model = new CoursesModel();

    if(!isset($_POST['submitted'])){
    $res = $this->courseDetailsAction();
     return $res;}

    if(isset($_POST['submitted']) && isset($_POST['edit'])){

      if(isset($_POST['submitted'])){
        $name = $this->evaluateCourseName($_POST['course_name']);
        $number = $this->evaluateCourseNumberForEdit($_POST['course_number']);
        $description = $this->evaluateCourseDesc(trim($_POST['course_description']));
      //  if(!empty($_FILES['course_image']) && $_FILES['course_image']['error'] == 0 ){
        //    $filename = $this->evaluateCourseImage($_FILES['course_image']['type']);
        //  }

          if(!$name || !$number || !$description )// toto || $filename==false){
          {
        //  if(isset($_FILES['course_image']) && $filename===false){$errors['file_type']="file type is not adquate. please upload only images<br>";}//{echo "file type is not adquate. please upload only images<br>";}
        //  elseif(isset($_FILES['course_image']) && ($_FILES['course_image']['name'] !="") && ($_FILES['course_image']['error'] != 0) ){$errors['file_general']="something is wrong with the file. plese try again or replace it.";}//{echo "something is wrong with the file. plese try again or replace it.";}
          $data['name']=$_POST['course_name'];
          $data['course_number']=$_POST['course_number'];
          $data['description']=$_POST['course_description'];

            $_POST['course_edit_errors']=$this->errors;
            $_POST['success']="false";

          header("url=/home/courses/courseEdit?id=".$_GET['id']);

            return $data;


        }

        if( $name && $number && $description && $filename==false){
          $this->course_name = $_POST['course_name'];
          $this->course_number = $_POST['course_number'];
          $this->course_description = trim($_POST['course_description']);
          $model->edit_course($_GET['id'], $this->course_number,$this->course_name, $this->course_description, $filename=null,0);
            header("location: /home/");
            $_POST['success']="true";
                  echo "returning filename is false";
        return $data;

        }

        if($name && $number && $description && $filename){
          $this->course_name = $_POST['course_name'];
          $this->course_number = $_POST['course_number'];
          $this->course_description = trim($_POST['course_description']);
          $filename =  $utilities->imageUpload('course_image', COURSE_IMAGE_UPLOADS, $this->course_number);
          $this->course_filename = $filename;
          $model->edit_course($_GET['id'], $this->course_number,$this->course_name, $this->course_description,  $this->course_filename,0);

          header("location: /home/");
          $_POST['success']="true";
            echo "returning all of the factors are valid";
          return $data;
        }






      }
        echo "returning at the end";
      return $data;


    }else{echo "no edit happened";}

    if(!isset($_POST['edit']) && isset($_POST['delete'])){
        echo "beggining delete";
        $is_deleted = 1;
        $model->edit_course($_GET['id'],null,null,null,null, 1);

        header("location: /home/");
        $_POST['success']="true";


    }else{echo "no delete happened";}




  }



// public function courseDeleteAction(){
//   global $utilities;
//   $model = new CoursesModel();
//
//   //validate course exists
//
//   //if course exists
//  echo "this is the get id: ". $_GET['id'];
//   if($model->delete_course("id", $_GET['id'])){
//     header("location: /home/");
//     $_POST['delete_success']="true";
//     echo "post delete success = ". $_POST['delete_success'];
//   }else{
//     //  header("location: /home/");
//       $_POST['delete_success']="false";
//       echo "post delete success  =". $_POST['delete_success'];
//   }
//$utulities->imageRemove();
  //$model



  //  todo:
  //delete course from courses2student
  // remove the joining of the course with students
  //remove the course inage from images folder
//}

public function countAllAction($courses, $filter,$value){
  $model = new CoursesModel();
  $data =   $model->count_group($courses, $filter,$value);
  return $data;

}

   //evaluating the name is minimum 1 word
private function evaluateCourseName($name){
      global $utilities;
      $regex = "^\w+( \w+)*$";
      if(!preg_match("/$regex/",$name)){
    $this->errors['name'] = $utilities->createUserMessage('name');
        return false;}
      else{return true;}
      }


private function evaluateCourseNumber($number){
      global $utilities;
      $model = new CoursesModel();
      $res= $model->get_course("course_number",$number);
      if(empty($res)){
        $regex = "^[1-9]{1}[0-9]{3,5}$";
        if(!preg_match("/$regex/", $number)){
          $this->errors['course_number']=$utilities->createUserMessage('course_number');
          return false;}
        else{return true;}}
      if(!empty($res)){
        $this->errors['course_number_unique']=$utilities->createUserMessage('course_number_unique');
        return false;}

      }
private function evaluateCourseNumberForEdit($number){
      global $utilities;
      $regex = "^[1-9]{1}[0-9]{3,5}$";
      if(!preg_match("/$regex/", $number)){
        $this->errors['course_number']=$utilities->createUserMessage('course_number');
        return false;}else{return true;}

     }


      //evaluating the description is minimum 1 word
private function evaluateCourseDesc($description){
       global $utilities;
       $regex = "^[a-zA-Z0-9\-\_\/\s,.]+$";
       if(!preg_match("/$regex/",$description)){
        $this->errors['description']=$utilities->createUserMessage('description');
         return false;}
       else{return true;}
       return true;
        }



}
 ?>

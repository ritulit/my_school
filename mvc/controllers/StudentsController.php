<?php

class StudentsController {

private $student_name, $student_phone, $student_email, $course_filename;

public function listAllAction() {

       $model = new StudentsModel();

     $list = $model->get_all_students();


    return $list;
   }

public function listAllThumbnailAction() {
        //preparing the courses list
        $model = new StudentsModel();

        $list = $model->get_all_students();

        //preparing ony an arrays of the thumbnail data
        $thumbnails_arr = Array();
        foreach($list as $value){
          if($value['is_deleted']==0){
            array_push($thumbnails_arr ,array('name'=>$value['name'],'img'=>$value['img'],'id'=>$value['id']));
          }
        }
        //assigning paths to the courses images
        foreach($thumbnails_arr as &$value){
        if(array_key_exists('img', $value) && (is_null($value['img'])|| $value['img']==="")){$value['img']=STUDENT_DEFAULT_IMAGE;}
        else{$value['img']=STUDENT_IMAGE_UPLOADS.$value['img'];}
        }

        return $thumbnails_arr;


   }

public function studentDetailsAction(){
     $model = new StudentsModel();
     $mydata = Array();
     $mydata  =   $model->get_student('id',$_GET['id']);
    // print_r($mydata);
     return $mydata;

   }

public function studentRegisterAction() {
    $utilities = new Utilities();
    $model = new StudentsModel();
    $data = Array();
    $name=false;
    $phone=false;
    $email=false;
    $filename = null;
    $errors= Array();


      if(isset($_POST['submitted'])){
        $name = $this->evaluateStudentName($_POST['student_name']);
        $phone= $this->evaluateStudentPhone($_POST['student_phone']);
        $email = $this->evaluateStudentEmail(trim($_POST['student_email']));
        if(isset($_FILES['student_image']) && $_FILES['student_image']['error'] == 0 ){
            $filename = $this->evaluateStudentImage($_FILES['student_image']['type']);
          }

        if(!$name || !$phone || !$email || $filename==false){
          if($name==false){$errors['student_name']="student name is invalid. minimum 1 char <br>";}//{echo "course name is invalid. minimum 1 char <br>";}
          if($phone==false){$errors['phone_number_invalid']="student phone is invalid.<br>";}//{echo "course number is invalid.<br>";}
          if($email==false){$errors['student_email']="student email is invalid .<br>";}//{echo  "course description is invalid . minimum 1 char .<br>";}
          if(isset($_FILES['student_image']) && $filename===false){$errors['file_type']="file type is not adquate. please upload only images<br>";}//{echo "file type is not adquate. please upload only images<br>";}
          elseif(isset($_FILES['student_image']) && ($_FILES['student_image']['name'] !="") && ($_FILES['student_image']['error'] != 0) ){$errors['file_general']="something is wrong with the file. plese try again or replace it.";}//{echo "something is wrong with the file. plese try again or replace it.";}
          $data=$errors;

            $_POST['success']="false";
          //  header('location: courseRegister');
          header("url=/home/students/studentRegister");

          //return $data;


        }

        if( $name && $phone && $email && $filename==false){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email = trim($_POST['student_email']);
          $model->create_student($this->student_name,$this->student_phone, $this->student_email, $filename=null);
            header("location: /home/");
            $_POST['success']="true";
          //  return true;

        }

        if($name && $phone && $email && $filename){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email = trim($_POST['student_email']);
          $filename =  $utilities->imageUpload('student_image', STUDENT_IMAGE_UPLOADS, $this->student_email);
          $this->student_filename = $filename;
          $model->create_student($this->student_name,$this->student_phone, $this->student_email,  $this->student_filename);
          header("location: /home/");
          $_POST['success']="true";
        }






      }
      return $data;

   }
//////////////////////////////////////////////////////////////////////////////////////
    public function studentEditAction(){
    $model = new StudentsModel();

    if(!isset($_POST['submitted'])){
    $res = $this->studentDetailsAction();
     return $res;}

    if(isset($_POST['submitted']) && isset($_POST['edit'])){

      if(isset($_POST['submitted'])){
        $name = $this->evaluateStudentName($_POST['student_name']);
        $phone = $this->evaluateStudentPhone($_POST['student_phone']);
        $email = $this->evaluateStudentEmailForEdit($_POST['student_email']);
      //  if(!empty($_FILES['course_image']) && $_FILES['course_image']['error'] == 0 ){
        //    $filename = $this->evaluateCourseImage($_FILES['course_image']['type']);
        //  }

      //  if(!$name || !$number || !$description || $filename==false){
          if(!$name || !$phone || !$email ){
          if($name==false){$errors['student_name']="course name is invalid. minimum 1 char <br>";}//{echo "course name is invalid. minimum 1 char <br>";}
          if($phone==false){$errors['student_phone_invalid']="phone number is invalid.<br>";}//{echo "course number is invalid.<br>";}
          if($email==false){$errors['student_email']="email is invalid . minimum 1 char .<br>";}//{echo  "course description is invalid . minimum 1 char .<br>";}
        //  if(isset($_FILES['course_image']) && $filename===false){$errors['file_type']="file type is not adquate. please upload only images<br>";}//{echo "file type is not adquate. please upload only images<br>";}
        //  elseif(isset($_FILES['course_image']) && ($_FILES['course_image']['name'] !="") && ($_FILES['course_image']['error'] != 0) ){$errors['file_general']="something is wrong with the file. plese try again or replace it.";}//{echo "something is wrong with the file. plese try again or replace it.";}
          $data['name']=$_POST['student_name'];
          $data['phone']=$_POST['student_phone'];
          $data['email']=$_POST['student_email'];
          $data['errors']=$errors;


            $_POST['success']="false";

          header("url=/home/students/studentEdit?id=".$_GET['id']);

            return $data;


        }

        if( $name && $phone && $email && $filename==false){
          $this->student_name = $_POST['student_name'];
            echo "student name is $this->student_name ";
          $this->student_phone = $_POST['student_phone'];
            echo "course name is $this->student_phoner ";
          $this->student_email= trim($_POST['student_email']);
            echo "student email is $this->student_email";
          $model->edit_student($_GET['id'],$this->student_name, $this->student_phone, $this->student_email, $filename=null,0);
            header("location: /home/");
            $_POST['success']="true";
                  echo "returning filename is false";
        return $data;

        }

        if($name && $phone && $email && $filename){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email = trim($_POST['student_email']);
          $filename =  $utilities->imageUpload('student_image', STUDENT_IMAGE_UPLOADS, $this->student_email);
          $this->student_filename = $filename;
          $model->edit_course($_GET['id'], $this->student_name, $this->student_phone, $this->student_email,  $this->student_filename,0);

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
        $model->edit_student($_GET['id'],null,null,null,null, 1);

        header("location: /home/");
        $_POST['success']="true";


    }else{echo "no delete happened";}




  }









public function countAllAction($students, $filter,$value){
  $model = new StudentsModel();
  $data =   $model->count_group($students, $filter,$value);
  return $data;

}

   //evaluating the name is minimum 1 word
private function evaluateStudentName($name){
      $regex = "^\w+( \w+)*$";
      if(!preg_match("/$regex/",$name)){return false;}
      else{return true;}
      }
     //valisation for numeric value of up to 6 digits
private function evaluateStudentPhone($number){
       $clean_phone = "";
         for($i=0; $i<strlen($number); $i++)
         if(is_numeric($number[$i])){
           $clean_phone.=$number[$i];
         }
        
        $regex = "^[0-9]{1}[0-9]{9,13}$";
        if(!preg_match("/$regex/",$clean_phone)){
            $errors[course_number]="student phone should be up to 11 digits.";
              return false;}
        else{return true;}


      }
private function evaluateStudentEmailForEdit($email){

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors[student_email]="email pattern is wrong.";
      return false;}else{return true;}

     }


      //evaluating the description is minimum 1 word
private function evaluateStudentEmail($email){
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $errors[student_email]="email pattern is wrong.";
     return false;}

  $model = new StudentsModel();
  $email = "\"".$email."\"";
  $res= $model->get_student("email",$email);


  if(empty($res) || $res==false){
          return true;}

  if(!empty($res)){
    $errors[student_email_unique]="email already exists. should be unique.";
    //echo "course number already exists. should be unique.";
    return false;}

return true;
}


//evaluating the uploaded file type is image
private function evaluateStudentImage($imageType){
  if(substr($imageType, 0, 5) !== "image"){return false;}
  else{return true;}

}

}
 ?>

<?php

class StudentsController {

private $student_name, $student_phone, $student_email, $course_filename;
public $errors = Array();

public function listAllAction() {

       $model = new StudentsModel();

     $list = $model->get_all_students();


    return $list;
   }

public function listAllThumbnailAction() {
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
     $data = Array();
     $data =   $model->get_student('id',$_GET['id']);
     if($data['is_deleted']=="1"){$data=[];
     return $data;}
     $data['student_courses'] =$this->getStudentCoursesByName($this->getStudentCourses($_GET['id']));
     $raw_ids= Array();
     $ids = $this->getStudentCourses($_GET['id']);
     foreach($ids as $value){
       array_push($raw_ids,$value['c_id']);
     }
     $data['student_courses_ids']=$raw_ids;
     return $data;

   }

public function studentRegisterAction() {
    global $utilities;
    $model = new StudentsModel();
    $data = Array();

      if(isset($_POST['submitted'])){
        $name = $this->evaluateStudentName($_POST['student_name']);
        $phone= $this->evaluateStudentPhone($_POST['student_phone']);
        $email = $this->evaluateStudentEmail(trim($_POST['student_email']));
        $s_courses;
        if(count($_POST['s_courses'])>0){$s_courses = $this->evaluateStudentCourses($_POST['s_courses']);}
        if(isset($_FILES['student_image']) && $_FILES['student_image']['error'] == 0 ){
            $filename = $utilities->evaluateImageType($_FILES['student_image']['type']);
          }



        if(!$name || !$phone || !$email ||  $filename==false){
          if(isset($_FILES['student_image']) && $filename===false){$this->errors['file_type']=$utilities->createUserMessage("file_type");}
          elseif(isset($_FILES['student_image']) && ($_FILES['student_image']['name'] !="") && ($_FILES['student_image']['error'] != 0) ){$this->errors['file_general']=$utilities->createUserMessage("file_general");}
          $_POST['success']="false";
          $_POST['student_register_errors']=$this->errors;
          header("url=/home/students/studentRegister");


        }

        if( $name && $phone && $email && $filename==false){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email = trim($_POST['student_email']);
          $model->create_student($this->student_name,$this->student_phone, $this->student_email, $filename=null);
          if(count($_POST['s_courses'])>0){
            $s_email = "\"".$this->student_email."\"";
            $s_model = new StudentsModel();
            $new_s = $s_model->get_student("email", $s_email);
            $this->insertStudentCourses($new_s['id'], $_POST['s_courses']);
          }
            header("location: /home/");
            $_POST['success']="true";

        }

        if($name && $phone && $email && $filename){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email = trim($_POST['student_email']);
          $filename =  $utilities->imageUpload('student_image', STUDENT_IMAGE_UPLOADS, $this->student_email);
          $this->student_filename = $filename;
          $model->create_student($this->student_name,$this->student_phone, $this->student_email,  $this->student_filename);
        //  die();
        if(count($_POST['s_courses'])>0){
          $s_email = "\"".$this->student_email."\"";
          $s_model = new StudentsModel();
          $new_s = $s_model->get_student("email", $s_email);
          var_dump($_POST['s_courses']);
          $this->insertStudentCourses($new_s['id'], $_POST['s_courses']);
        }
          header("location: /home/");
          $_POST['success']="true";
        }






      }
      return $data;

   }
//////////////////////////////////////////////////////////////////////////////////////
    public function studentEditAction(){
    $model = new StudentsModel();
    global $utilities;

    if(!isset($_POST['submitted'])){
    $res = $this->studentDetailsAction();
     return $res;}

    if(isset($_POST['submitted']) && isset($_POST['edit'])){

      if(isset($_POST['submitted'])){
        $name = $this->evaluateStudentName($_POST['student_name']);
        $phone = $this->evaluateStudentPhone($_POST['student_phone']);
        $email = $this->evaluateStudentEmailForEdit($_POST['student_email']);
        $s_courses;
        if(count($_POST['s_courses'])>0){$s_courses = $this->evaluateStudentCourses($_POST['s_courses']);}
      //  if(!empty($_FILES['course_image']) && $_FILES['course_image']['error'] == 0 ){
        //    $filename = $this->evaluateCourseImage($_FILES['course_image']['type']);
        //  }

          if(!$name || !$phone || !$email ) //todo: || $filename==false){
          {
        //  if(isset($_FILES['course_image']) && $filename===false){$errors['file_type']="file type is not adquate. please upload only images<br>";}//{echo "file type is not adquate. please upload only images<br>";}
        //  elseif(isset($_FILES['course_image']) && ($_FILES['course_image']['name'] !="") && ($_FILES['course_image']['error'] != 0) ){$errors['file_general']="something is wrong with the file. plese try again or replace it.";}//{echo "something is wrong with the file. plese try again or replace it.";}
          $data['name']=$_POST['student_name'];
          $data['phone']=$_POST['student_phone'];
          $data['email']=$_POST['student_email'];
            $_POST['success']="false";
            $_POST['student_edit_errors']=$this->errors;
            header("url=/home/students/studentEdit?id=".$_GET['id']);

            return $data;


        }

        if( $name && $phone && $email && $filename==false){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email= trim($_POST['student_email']);
          $model->edit_student($_GET['id'],$this->student_name, $this->student_phone, $this->student_email, $filename=null,0);
          $this->insertStudentCourses($_GET['id'], $_POST['s_courses'],true);
          header("location: /home/");
          $_POST['success']="true";

           return $data;

        }

        if($name && $phone && $email && $filename){
          $this->student_name = $_POST['student_name'];
          $this->student_phone = $_POST['student_phone'];
          $this->student_email = trim($_POST['student_email']);
          $filename =  $utilities->imageUpload('student_image', STUDENT_IMAGE_UPLOADS, $this->student_email);
          $this->student_filename = $filename;
          $model->edit_student($_GET['id'], $this->student_name, $this->student_phone, $this->student_email,  $this->student_filename,0);
          $this->insertStudentCourses($_GET['id'], $_POST['s_courses'],true);
          header("location: /home/");
          $_POST['success']="true";

          return $data;
        }






      }

      return $data;


    }else{echo "no edit happened";}

    if(!isset($_POST['edit']) && isset($_POST['delete'])){
        echo "beggining delete";

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

public function getStudentCourses($id){
  $model = new StudentsModel();
  $data = $model->get_student_courses($id);
  return $data;
}

public function getStudentCoursesByName($courses_ids){
  $model = new CoursesModel();
  $c_name_list= Array();
  foreach($courses_ids as $value){
    array_push($c_name_list, ($model->get_course('id',$value['c_id'])['name']));
  }

  return  $c_name_list;
}


private function insertStudentCourses($student_id, $courses_arr,$is_edit=false){
    $model = new StudentsModel();
    $model->insert_student_courses($student_id, $courses_arr,$is_edit);

}

   //evaluating the name is minimum 1 word
private function evaluateStudentName($name){
  global $utilities;
      $regex = "^\w+( \w+)*$";
      if(!preg_match("/$regex/",$name)){
        $this->errors['name'] = $utilities->createUserMessage('name');
        return false;}
      else{return true;}
      }
     //valisation for numeric value o f8-13 digits
private function evaluateStudentPhone($number){
  global $utilities;

       $clean_phone = "";
         for($i=0; $i<strlen($number); $i++)
         if(is_numeric($number[$i])){
           $clean_phone.=$number[$i];
         }

        $regex = "^[0-9]{1}[0-9]{8,13}$";
        if(!preg_match("/$regex/",$clean_phone)){
            $this->errors['phone'] = $utilities->createUserMessage('phone');
              return false;}
        else{return true;}


      }
private function evaluateStudentEmailForEdit($email){
  global $utilities;

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $this->errors['email'] = $utilities->createUserMessage('email');
      return false;}else{return true;}

     }


      //evaluating the description is minimum 1 word
private function evaluateStudentEmail($email){
  global $utilities;

 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $this->errors['email_pattern'] = $utilities->createUserMessage('email_pattern');
     return false;}

  $model = new StudentsModel();
  $email = "\"".$email."\"";
  $res= $model->get_student("email",$email);


  if(empty($res) || $res==false){
    return true;}

  if(!empty($res)){
    $this->errors['email_exists'] = $utilities->createUserMessage('email_exists');
    return false;}

return true;
}

private function evaluateStudentCourses($courses_arr){
  global $utilities;
  $courses = new CoursesController();
  $res= $courses->listAllThumbnailAction();
  $res_ids = Array();
  foreach($res as $value){
  array_push($res_ids,$value['id']) ;
  }
foreach($courses_arr as $value){
  $is_there = array_search($value,$res_ids);
  if($is_there==false){return false;}
 else{
  $this->errors['course_doesnt_exist'] = $utilities->createUserMessage('course_doesnt_exist');
  return true;}

    }
  }


}
 ?>

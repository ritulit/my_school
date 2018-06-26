<?php

class ManagersController {

private $manager_name,$manager_role, $manager_phone, $manager_email,$manager_password, $manager_filename;
public $errors = Array();

public function listAllAction() {

       $model = new ManagersModel();

     $list = $model->get_all_managers();


    return $list;
   }

public function listAllThumbnailAction() {
        //preparing the courses list
        $model = new ManagersModel();

        $list = $model->get_all_managers();


        //preparing ony an arrays of the thumbnail data
        $thumbnails_arr = Array();
        foreach($list as $value){
          if($value['is_deleted']==0){
            array_push($thumbnails_arr ,array('name'=>$value['name'],'img'=>$value['img'],'id'=>$value['id']));
          }
        }
        //assigning paths to the courses images
        foreach($thumbnails_arr as &$value){
        if(array_key_exists('img', $value) && (is_null($value['img'])|| $value['img']==="")){$value['img']=ADMINISTRATOR_DEFAULT_IMAGE;}
        else{$value['img']=ADMINISTRATOR_IMAGE_UPLOADS.$value['img'];}
        }

        return $thumbnails_arr;


   }

public function managerDetailsAction(){
     $model = new ManagersModel();
     $data = Array();
     $data =   $model->get_manager('id',$_GET['id']);
     $data['role_name'] = $model->get_manager_role($data['role']);

     return $data;

   }

public function managerRegisterAction() {
    global $utilities;
    $model = new ManagersModel();


      if(isset($_POST['submitted']))
      {
        $name = $this->evaluateManagerName(trim($_POST['manager_name']));
        $phone= $this->evaluateManagerPhone($_POST['manager_phone']);
        $email = $this->evaluateManagerEmail(trim($_POST['manager_email']));
        $role = $this->evaluateManagerRole($_POST['manager_role']);
        $password = $this->evaluateManagerPassword($_POST['manager_password']);
        $retype_password =  $utilities->compareValues($_POST['manager_password'],$_POST['manager_password_retype']);
        if(isset($_FILES['manager_image']) && $_FILES['manager_image']['error'] == 0 ){
            $filename = $utilities->evaluateImageType($_FILES['manager_image']['type']);
          }

        if(!$name || !$phone || !$email || !$role || !$password || !$retype_password || $filename==false){
          if($retype_password==false){$this->errors['password_retype']=$utilities->createUserMessage("password_retype");}
          if(isset($_FILES['manager_image']) && $filename===false){$this->errors['file_type']=$utilities->createUserMessage("file_type");}
          elseif(isset($_FILES['manager_image']) && ($_FILES['manager_image']['name'] !="") && ($_FILES['manager_image']['error'] != 0) ){$this->errors['file_general']=$utilities->createUserMessage("file_general");}


            $_POST['success']="false";
            $_POST['manager_register_errors']=$this->errors;
            header("url=/administration/managers/managerRegister");



        }

        if( $name && $phone && $email && $role && $password && $retype_password && $filename==false){
          $this->manager_name = trim($_POST['manager_name']);
          $this->manager_phone = $_POST['manager_phone'];
          $this->manager_email = trim($_POST['manager_email']);
          $this->manager_role = $_POST['manager_role'];
          $this->manager_password =password_hash($_POST['manager_password'],PASSWORD_DEFAULT);
          $model->create_manager($this->manager_name,$this->manager_phone, $this->manager_email,$this->manager_role,$this->manager_password, $filename=null);
            header("location: /administration/");
            $_POST['success']="true";

        }

        if( $name && $phone && $email && $role && $password && $retype_password && $filename){
          $this->manager_name = trim($_POST['manager_name']);
          $this->manager_phone = $_POST['manager_phone'];
          $this->manager_email = trim($_POST['manager_email']);
          $this->manager_role = $_POST['manager_role'];
          $this->manager_password = password_hash($_POST['manager_password'],PASSWORD_DEFAULT);
          $filename =  $utilities->imageUpload('manager_image', ADMINISTRATOR_IMAGE_UPLOADS, $this->manager_email);
          $this->manager_filename = $filename;
          $model->create_manager($this->manager_name,$this->manager_phone, $this->manager_email,$this->manager_role,$this->manager_password,  $this->manager_filename);
          header("location: /administration/");
          $_POST['success']="true";
        }

      }

   }
//////////////////////////////////////////////////////////////////////////////////////
public function managerEditAction(){
    $model = new ManagersModel();
    global $utilities;

    if(!isset($_POST['submitted'])){
    $res = $this->managerDetailsAction();
     return $res;}

    if(isset($_POST['submitted']) && isset($_POST['edit'])){

      if(isset($_POST['submitted'])){
        $name = $this->evaluateManagerName(trim($_POST['manager_name']));
        $phone = $this->evaluateManagerPhone($_POST['manager_phone']);
        $email = $this->evaluateManagerEmailForEdit($_POST['manager_email']);
        $role = $this->evaluateManagerRole($_POST['manager_role']);
        if($_POST['manager_password'] != null || $_POST['original_manager_password'] !=null || $_POST['manager_password_retype'] !=null)
        {$password =  $this->evaluateManagerPassword($_POST['manager_password']);
         $old_password = $this->evaluateManagerCurrentPasswordForEdit($_POST['original_manager_password']);
         $retype_password =  $utilities->compareValues($_POST['manager_password'],$_POST['manager_password_retype']);}
         else{$password=true; $old_password=true; $retype_password=true;}

      //  if(!empty($_FILES['course_image']) && $_FILES['course_image']['error'] == 0 ){
        //    $filename = $this->evaluateCourseImage($_FILES['course_image']['type']);
        //  }

          if(!$name || !$phone || !$email || !$role || !$password || !$old_password || !$retype_password )//todo || $filename==false){
          {

        //  if(isset($_FILES['course_image']) && $filename===false){$errors['file_type']="file type is not adquate. please upload only images<br>";}//{echo "file type is not adquate. please upload only images<br>";}
        //  elseif(isset($_FILES['course_image']) && ($_FILES['course_image']['name'] !="") && ($_FILES['course_image']['error'] != 0) ){$errors['file_general']="something is wrong with the file. plese try again or replace it.";}//{echo "something is wrong with the file. plese try again or replace it.";}
          $data['name']=$_POST['manager_name'];
          $data['phone']=$_POST['manager_phone'];
          $data['email']=$_POST['manager_email'];
          $data['role']=$_POST['manager_role'];
          $data['img']= $_POST['img_holder'];


            $_POST['success']="false";
            $_POST['manager_edit_errors']=$this->errors;
            header("url=/administration/managers/managerEdit?id=".$_GET['id']);

            return $data;


        }

        if( $name && $phone && $email && role && $old_password && $retype_password && $filename==false){
          $this->manager_name = trim($_POST['manager_name']);
          $this->manager_phone = $_POST['manager_phone'];
          $this->manager_email= trim($_POST['manager_email']);
          $this->manager_role = $_POST['manager_role'];
          $this->manager_password =password_hash($_POST['manager_password'],PASSWORD_DEFAULT);
          $model->edit_manager($_GET['id'],$this->manager_name, $this->manager_phone, $this->manager_email,$this->manager_role,$this->manager_password, $filename=null,0);

            header("location: /administration/");
            $_POST['success']="true";
            return $data;

        }

        if($name && $phone && $email && role && $old_password && $retype_password && $filename){
          $this->manager_name = trim($_POST['manager_name']);
          $this->manager_phone = $_POST['manager_phone'];
          $this->manager_email = trim($_POST['manager_email']);
          $this->manager_role = $_POST['manager_role'];
          $this->manager_password =password_hash($_POST['manager_password'],PASSWORD_DEFAULT);
          $filename =  $utilities->imageUpload('manager_image', ADMINISTRATOR_IMAGE_UPLOADS, $this->manager_email);
          $this->manager_filename = $filename;
          $model->edit_course($_GET['id'], $this->manager_name, $this->manager_phone, $this->manager_email,  $this->manager_filename,0);

          header("location: /administration/");
          $_POST['success']="true";
          return $data;
        }






      }
      return $data;


    }else{echo "no edit happened";}

    if(!isset($_POST['edit']) && isset($_POST['delete'])){
        $is_deleted = 1;
        $model->edit_manager($_GET['id'],null,null,null,null,null,null, 1);

        header("location: /administration/");
        $_POST['success']="true";


    }else{echo "no delete happened";}




  }

public function countAllAction($managers, $filter,$value){
  $model = new ManagersModel();
  $data =   $model->count_group($managers, $filter,$value);
  return $data;

}

   //evaluating the name is minimum 1 word
private function evaluateManagerName($name){
  global $utilities;
        $regex = "^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$";
      if(!preg_match("/$regex/",$name)){
        $this->errors['name']=$utilities->createUserMessage("name");
        return false;}
      else{return true;}
      }
     //valisation for numeric value of 8-13 digits
private function evaluateManagerPhone($number){
  global $utilities;
         $clean_phone = "";
         for($i=0; $i<strlen($number); $i++)
         if(is_numeric($number[$i])){
           $clean_phone.=$number[$i];
         }

        $regex = "^[0-9]{1}[0-9]{8,13}$";
        if(!preg_match("/$regex/",$clean_phone)){
            $this->errors['phone']=$utilities->createUserMessage("phone");
              return false;}
        else{return true;}


      }
private function evaluateManagerEmailForEdit($email){
  global $utilities;

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['manager_email']="email pattern is wrong.";
      return false;}else{return true;}

     }


      //evaluating the description is minimum 1 word
private function evaluateManagerEmail($email){
  global $utilities;
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $this->errors['email_pattern']=$utilities->createUserMessage("email_pattern");
     return false;}

  $model = new ManagersModel();
  $email = "\"".$email."\"";
  $res= $model->get_manager("email",$email);


  if(empty($res) || $res==false){
          return true;}

  if(!empty($res)){
    $this->errors['email_exists']=$utilities->createUserMessage("email_exists");
    //echo "course number already exists. should be unique.";
    return false;}

   return true;
}

public function get_manager_role($role_id){
  global $utilities;
  $model = new ManagersModel();
  $list = $model->get_roles_list();


}



private function evaluateManagerRole($role){
  global $utilities;
  $model = new ManagersModel();
  $list = $model->get_roles_list();
  $res =Array();
  foreach($list as $value){
    array_push($res, $value['id']);
  }
  if(!in_array($role, $res)){
    $this->errors['role']=$utilities->createUserMessage("role");
     return false;}
  else{return true;}

}

private function evaluateManagerPassword($password) {
  global $utilities;
  $passRegex ="(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,10})$";
  if(!preg_match("/".$passRegex."/",$password)){
    $this->errors['password']=$utilities->createUserMessage("password");
    return false;}
   return true;

}
private function evaluateManagerCurrentPasswordForEdit($password){
global $utilities;
$model = new ManagersModel();
$manager = $model->get_manager('id',$_GET['id']);
if(!password_verify($password, $manager['password'])){
  $this->errors['password_old']=$utilities->createUserMessage("password_old");
  return false;}
else{return true;}

}

}
 ?>

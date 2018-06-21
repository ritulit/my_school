<?php
require_once('inc/autoload.php');
class Utilities {


  public function imageUpload($file_arr_name, $dest, $new_name){
      $arr = explode(".", $_FILES[$file_arr_name]['name'] );
      $filename_ext =end($arr);
      $filename = $new_name.".".$filename_ext;
      $dest_path  = sprintf('%s/%s/%s',rtrim($_SERVER['DOCUMENT_ROOT'], "/"), trim($dest , "/"), $filename);
      $is_success = move_uploaded_file($_FILES[$file_arr_name]['tmp_name'], $dest_path);
      if($is_success) {
        echo "file upload was done";
        return $filename;}
        else{
          echo "file upload was unssuseccful. please try again by editing the course.";
          return false;}
      }



  public function imageRemove(){

  }
///////////////////////////////////////////////////////////////////////////////////////////////////////

  function is_logged_in() {
  	$user = new User;
  	return($user->fetchUser('token',$_COOKIE["TOKEN_KEY_NAME"]));
  }

  function restrict_access() {
      if(!is_logged_in()) {
          header('Location: /login.php?error=ACCESS DENIED');
      }

  }




 function createUserMessage($value){
 global $instance;

  /*   if ($_myDB->connect_error) {
         die("Connection failed: " . $_myDB->connect_error);
       }*/

   $res = $instance->query_2_array("SELECT * FROM user_messages WHERE name ='".$value."'" );

   return $res[0]['description'];

 }



}

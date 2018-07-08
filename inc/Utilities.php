<?php
require_once('inc/autoload.php');
class Utilities {

  private static $instance = null;

  private function __construct()
  {

  }

  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new Utilities();
    }

    return self::$instance;
  }


public function evaluateImageType($imageType){
    if(substr($imageType, 0, 5) !== "image"){return false;}
    else{return true;}

  }


public function imageUpload($file_arr_name, $dest, $new_name){
    var_dump($file_arr_name);
      $arr = explode(".", $_FILES[$file_arr_name]['name'] );
      $filename_ext =end($arr);
      $filename = $new_name.".".$filename_ext;
      $dest_path  = sprintf('%s/%s/%s',rtrim($_SERVER['DOCUMENT_ROOT'], "/"), trim($dest , "/"), $filename);
      $is_success = move_uploaded_file($_FILES[$file_arr_name]['tmp_name'], $dest_path);
      if($is_success) {
        //echo "file upload was done";
        return $filename;}
        else{
          echo "file upload was unssuseccful. please try again by editing the course.";
          return false;}
      }



public function imageRemove(){

  }
//not for omparing null values
public function compareValues($first_value, $second_value){
if($first_value==null && $second_value==null){return false;}
if($first_value !== $second_value){return false;}
else{return true;}

}
//when  a successful login takes place a session is created and added to the user. it will be ridden over upon logout or a new login so only one active session per user is alowed
  public function sessionGenerator(){


  }
///////////////////////////////////////////////////////////////////////////////////////////////////////


// function is_logged_in() {
// 	$user = new AuthModel;
// 	return($user->authenticate_user("managers",$_COOKIE["TOKEN_KEY_NAME"]));
// }
//
// function restrict_access() {
//     if(!is_logged_in()) {
//         header('Location: http://localhost/orit/login.php?error=ACCESS DENIED');
//     }


///////////////////////////////////////////////////////////////////////////////////

 function createUserMessage($value){
   global $instance;


   $res = $instance->query_2_array("SELECT * FROM user_messages WHERE name ='".$value."'" );
   if(empty($res)){
     $res=$instance->query_2_array("SELECT * FROM user_messages WHERE name = \"general\"" );
     return $res[0]['description'];
   }
   return $res[0]['description'];

 }



}
$utilities = Utilities::getInstance();
?>

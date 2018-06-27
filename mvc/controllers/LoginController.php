<?php

class LoginController{
private $email,$password;
public $errors = Array();


public function loginAction(){
    global $utilities;
  $model = new AuthModel();

    if(isset($_POST['submitted'])){
      $this->email = $_POST['email'];
      $this->password = $_POST['password'];
      $user= $model->authenticate_user("managers",$_POST['email']);
      //var_dump($user);




    if(((count($user)==1))&&(password_verify($this->password , $user[0]["password"]))){

      echo "passowrd verified";
          //set $_COOKIE
          //start session
          $_POST['success']="true";
          //header("url= /home/");
          header("location: /home/");



      }
    else{
      $this->errors['failed_login']=$utilities->createUserMessage("failed_login");

        $_POST['auth']="false";
        $_POST['login_errors']=$this->errors;
      //  header( 'Location: /auth/login' );
             header("url=/auth/login");

      }




 }
 //
 // function validateLogin(){
	// if(isset($_POST['username'])){
	// 	$user = getDBObjByKey('users', 'email', $_POST['username']);
	// 	if((count($user)==1)&&(password_verify($_POST["password"], $user[0]["u_id"]))){
	//     refreshToken("users",'email',$_POST["username"], 'u_id', $_POST["password"]);
	// 	$userWithFreshToken = getDBObjByKey('users', 'email', $_POST["username"]);
	// 	setcookie("TOKEN_KEY_NAME",$userWithFreshToken[0]["u_id"], time()+60);
	// 	header( 'Location: http://localhost/orit/myaccount.php' );
	// 	return true;
	//   }else{
	// 	createErrorMessage("failed_login");
	//     return false;}
 //
 //
	// }



}




}

?>

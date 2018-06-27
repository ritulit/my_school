<?php

class AuthModel{


//user_type is the table to search on (managers, students..)

public function authenticate_user($user_table, $email){

global $instance;
$query = "SELECT * from $user_table WHERE email = \"$email\" ";


$user = $instance->query_2_array($query);
return $user;

}


//
// public_function is_logged_in() {
//   $user = new User;
//   return($user->fetchUser('token',$_COOKIE["TOKEN_KEY_NAME"]));
// }


}

?>

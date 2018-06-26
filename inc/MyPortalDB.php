
<?php


include_once "./Database.php";
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

class MyPortalDB implements Database{

  private static $instance = null;
  private $_myDB;



  // The db connection is established in the private constructor.
  private function __construct()
   {
    if($_SERVER['HTTP_HOST']==PRD_SERVER_HOST){$this->_myDB = new mysqli(PRD_DB_HOST, PRD_DB_USERNAME, PRD_DB_PASSWORD, PRD_DB_NAME);}
    else{$this->_myDB = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);}

   }

  public static function getInstance()
   {
    if(!self::$instance)
    {
      self::$instance = new MyPortalDB();
    }

    return self::$instance;
   }

  public function getConnection()
  {
    return $this->_myDB;
  }




     public function query_2_array($query) {
       $results_assoc_array = []  ;
       $result =$this->_myDB->query($query);
       if ($result !== false){

             while ( $row = $result->fetch_assoc() ) {array_push($results_assoc_array, $row);}
		  } else {
			  echo  $_myDB->error;
			    return false;}

           return $results_assoc_array;
    }

    //$dest is the table name $content the array of values per line
		public function insertToDB($dest , $content){
	  		global $instance;
		  	global $_myDB;
		  	$query_into = "INSERT INTO {$dest} ";
        $query_values;
         foreach($content as $value){
           global   $query_values;
            $query_keys = "(" . implode(", ", array_keys($value)) .")" ;
            $query_values .= "(\"" .implode("\",\"", array_values($value)) ."\")". ","  ;
            }
           $query_value = " VALUES ";

        $query_values = rtrim($query_values , ", ");

         $query = $query_into . $query_keys . $query_value . $query_values ;

		     $result = $_myDB->query($query);
        	if ($result !== true){
        //todo: log the error to the log file
		     echo  $_myDB->error;
			   return false;}



		}
    public function insertToDBToEdit($dest , $content){
        global $instance;
        global $_myDB;
        $query_into = "INSERT INTO {$dest} ";
        $query_values;
         foreach($content as $value){
           global   $query_values;
            $query_keys = "(" . implode(", ", array_keys($value)) .")" ;
            $query_values .= "(\"" .implode("\",\"", array_values($value)) ."\")". ","  ;
            }
           $query_value = " VALUES ";

        $query_values = rtrim($query_values , ", ");

         $query = $query_into . $query_keys . $query_value . $query_values ;

         $addition = " ON DUPLICATE KEY UPDATE "    ;
        // var_dump($content);
         foreach($content[0] as $key=>$value){
           if($value!=null || $value!=""){
             $addition .= $key."= VALUES($key),";
           }

         }


        $query .= rtrim($addition,",");
    echo $query;
  //  die();
         //add here the ON DUPLICATE code to allow editing of values for an exisiting course

         $result = $_myDB->query($query);
          if ($result !== true){
        //todo: log the error to the log file
         echo  $_myDB->error;
         return false;}



    }


 //$source is the table name, $data is the assoc array of column names and values, $conditions is a string of the booloan conditions of where operator
    public function editFromDB($source, $data, $condition=null){
      global $instance;
      global $_myDB;
      //
      $query = "UPDATE $source SET ";
      $edit_data = Array();
      foreach($data as $key=>$vale){
      array_push($edit_data, "$key=\"$value\"");
      }
      //
      $query .= implode(",", $edit_data);
      if($condition !== null){
      $query .= " WHERE ". $condition;
      }
      $result = $_myDB->query($query);
      if ($result !== true){
      //todo: log the error to the log file
      echo  $_myDB->error;
      return false;}

    }

    // the conditions array is expected to have items with bool operator , key , math operator and value to connect with the next condition. this could get really complex to build generically
    //sql delete statement will not be used in this project as i am just setting a flag to mark a deleted entity
    public function deleteFromDB($source, $conditions=null){
       global $instance;
      	global $_myDB;
      $query = "DELETE FROM {$source} WHERE  ";
      if($conditions!=null ){
         $query .= $conditions;
         echo $query;
         $result = $_myDB->query($query);
        }

      		if ($result !== true){

              //this code is for returning select query results only
      					while ( $row = $instance->$_myDB->fetch_assoc() ) {array_push($results_assoc_array, $row);}
                return $results_assoc_array;
      	       } else {
      		     echo  $_myDB->error;
      			   return false;}




    }







}
//delete the $instance and turn to this class method in a statis way MyPortalDB::query_2_array
//new MyPortalDB();
$instance = MyPortalDB::getInstance();
$_myDB = $instance->getConnection();
//var_dump($instance);



?>

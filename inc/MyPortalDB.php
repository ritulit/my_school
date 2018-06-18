
<?php


include_once "./Database.php";
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

class MyPortalDB implements Database{

  private static $instance = null;
  private $_myDB;



  // The db connection is established in the private constructor.
  private function __construct()
  {
  if($_SERVER['HTTP_HOST']=="ritulit.tk"){$this->_myDB = new mysqli(PRD_DB_HOST, PRD_DB_USERNAME, PRD_DB_PASSWORD, PRD_DB_NAME);}
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
		  	$results_assoc_array = [];
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

   //this code is for returning select query results only
					while ( $row = $instance->$_myDB->fetch_assoc() ) {array_push($results_assoc_array, $row);}
          return $results_assoc_array;
	    } else {
		   echo  $_myDB->error;
			 return false;}



		}

  	public function insert_2_db( $query){

	  	 $result = $this->_myDB->query($query);
		   if ($result==false){echo "i had a problem inserting";
		   return $result;}
		    else{return false;}

    	}




}

$instance = MyPortalDB::getInstance();
$_myDB = $instance->getConnection();
//var_dump($instance);



?>

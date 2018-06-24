<?php


class ManagersModel {

    public function get_all_managers($type=null, $value=null) {
      global $instance;
        //return all courses
        $q = "SELECT * FROM managers WHERE 1";
       //  Filter:
        if($type!=null && $value!=null) {
            $q .= ' AND '.$type.'='. $value;

              return $instance->query_2_array($q);

        }else {return $instance->query_2_array($q);}
        //Sort:
      /*  if(isset($filter['sort_by'])) {
            $q .= ' ORDER BY '. $filter['sort_by'];
        }*/
    }

    public function count_group($group, $filter_type, $filter_value){
      //add count query that returns an int
      global $instance;
      $q = "select count(*) from ". $group. " where 1";
      if($filter_type!=null && $filter_value!=null) {
          $q .= ' AND '.$filter_type.'='. $filter_value;

          $res= $instance->query_2_array($q);

            return $res;

      }else {$res= $instance->query_2_array($q);

            return $res;}
      }

    public function get_manager($type,$value) {
        global $instance;
        $someArr = array();
        //code for adding COURSES list per course
		    // $s_list =$instance->query_2_array("select name from students n inner join courses2students c2s on(c.id =c2s.s_id) where c2s.c_id=".$id);
		    // foreach ($_list as $value){
		    // array_push($someArr, $value['name']);}

       $data = $this->get_all_managers($type,$value);
       if(empty($data)){return $data;}
       $data = $data[0];
       if(!empty($data) &&($data['img']==null || $data['img']=="")){$data['img']="\"".ADMINISTRATOR_DEFAULT_IMAGE."\"";}elseif(!empty($data)){ $data['img'] ="\"".ADMINISTRATOR_IMAGE_UPLOADS.$data['img']."\"";}


        return $data;


    }


    public function create_manager($manager_name,$manager_phone,$manager_email,$manager_role,$manager_password, $manager_image){
            global $instance;
            global $_myDB;
     $arr = Array (['name'=>$manager_name,'phone'=>$manager_phone, 'email'=>$manager_email,'role'=>$manager_role,'password'=>$manager_password, 'img'=>$manager_image]);
     $instance->insertToDB("managers",$arr);

     }

    public function edit_manager($manager_id,$manager_name,$manager_phone,$manager_email,$manager_role,$manager_password,  $manager_image, $manager_deleted){
      global $instance;
      $manager=$this->get_manager("id",$manager_id);

      if(!empty($manager) && $manager['is_deleted']==0){

        $data = Array(['id'=>$manager_id,'name'=>$manager_name, 'phone'=>$manager_phone,'email'=>$manager_email, 'role'=>$manager_role,'password'=>$manager_password,'img'=>$manager_image, 'is_deleted'=>$manager_deleted]);
        $instance->insertToDBToEdit("managers",$data);
        return true;
      }else{
        echo " this manager doesnt exist";
        return false;
      }
    }


    public function get_manager_role($role_id){
      global $instance;
        $q = "SELECT * FROM roles where id=$role_id";
        $role= $instance->query_2_array($q);
        if(!empty($role)){return $role[0]['name'];}
        else{return false;}
        }


    public function get_roles_list(){
        global $instance;
          $q = "SELECT * FROM roles";
          $list = $instance->query_2_array($q);
          return $list ;
    }
//////////////////////////////////////////////////////////


    //
    // public function delete_student($id){
    //
    // }
  }
?>

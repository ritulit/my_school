<?php


class StudentsModel {




    public function get_all_students($type=null, $value=null) {
      global $instance;
        //return all courses
        $q = "SELECT * FROM students WHERE 1";
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

    public function get_student($type,$value) {
        global $instance;
        $someArr = array();
        //code for adding COURSES list per course
		    // $s_list =$instance->query_2_array("select name from students n inner join courses2students c2s on(c.id =c2s.s_id) where c2s.c_id=".$id);
		    // foreach ($_list as $value){
		    // array_push($someArr, $value['name']);}

       $data = $this->get_all_students($type,$value);
       if(empty($data)){return $data; }
       $data = $data[0];
       if(!empty($data) &&($data['img']==null || $data['img']=="")){$data['img']="\"".STUDENT_DEFAULT_IMAGE."\"";}elseif(!empty($data)){ $data['img'] ="\"".STUDENT_IMAGE_UPLOADS.$data['img']."\"";}


        return $data;


    }


    public function create_student($student_name, $student_phone, $student_email,$student_image){
            global $instance;

     $arr = Array (['name'=>$student_name, 'phone'=>$student_phone, 'email'=>$student_email, 'img'=>$student_image]);
     $instance->insertToDB("students",$arr);

     }

    public function edit_student($student_id,$student_name, $student_phone,$student_email, $student_image, $student_deleted){
      global $instance;
      $student=$this->get_student("id",$student_id);

      if(!empty($student) && $student['is_deleted']==0){

        $data = Array(['id'=>$student_id,'name'=>$student_name, 'phone'=>$student_phone, 'email'=>$student_email,'img'=>$student_image, 'is_deleted'=>$student_deleted]);
        $instance->insertToDBToEdit("students",$data);
        return true;
      }else{
        echo " this student doesnt exist";
        return false;
      }
    }

    public function get_student_courses($id){
    global $instance;
    $query = "SELECT s2u.c_id from students2courses s2u join students s on s.id = s2u.s_id where s.id=$id";
    $data = $instance->query_2_array($query);

    return $data;

    }

    public function insert_student_courses($student_id, $courses_arr,$edit=false){
     global $instance;
     $student_course_pair = Array();
     if($edit==true){
       if(!empty($courses_arr) ||$course_arr!=null){
        
         $instance->deleteFromDB("students2courses","s_id=$student_id");
         foreach($courses_arr as $value){
           array_push($student_course_pair,['s_id'=>$student_id,'c_id'=>$value]);
          }
           $instance->insertToDB("students2courses",array_values($student_course_pair));

         }else{
             $instance->deleteFromDB("students2courses","s_id=$student_id");}

     }
     else{
     foreach($courses_arr as $value){
       array_push($student_course_pair,['s_id'=>$student_id,'c_id'=>$value]);
      }
       $instance->insertToDB("students2courses",array_values($student_course_pair));
     }


    }
//////////////////////////////////////////////////////////


    //
    // public function delete_student($id){
    //
    // }
  }

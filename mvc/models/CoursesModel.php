<?php


class CoursesModel {




    public function get_all_courses($type=null, $value=null) {
      global $instance;
        //return all courses
        $q = "SELECT * FROM courses WHERE 1";
       //  Filter:
        if($type!=null && $value!=null) {
            $q .= ' AND '.$type.'='. $value;
              return $instance->query_2_array($q);

        }else {  return $instance->query_2_array($q);}
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

    public function get_course($type,$value) {
        global $instance;
        $someArr = array();
        //code for adding students list per course
		    // $s_list =$instance->query_2_array("select name from students n inner join courses2students c2s on(c.id =c2s.s_id) where c2s.c_id=".$id);
		    // foreach ($_list as $value){
		    // array_push($someArr, $value['name']);}

       $data = $this->get_all_courses($type,$value);
       $data = $data[0];
       if(!empty($data) &&($data['img']==null || $data['img']=="")){$data['img']="\"".COURSE_DEFAULT_IMAGE."\"";}elseif(!empty($data)){ $data['img'] ="\"".COURSE_IMAGE_UPLOADS.$data['img']."\"";}
       if(empty($data)){return $data;}

        return $data;


    }


    public function create_course($course_name, $course_number, $course_description,$course_image){
            global $instance;
            global $_myDB;
     $arr = Array (['name'=>$course_name, 'course_number'=>$course_number, 'description'=>$course_description, 'img'=>$course_image]);
     $instance->insertToDB("courses",$arr);

     }

    public function edit_course($course_id,$course_number,$course_name, $course_description, $course_image, $course_deleted){
      global $instance;
      $course=$this->get_course("id",$course_id);

      if(!empty($course) && $course['is_deleted']==0){
      echo "all ok";
        $data = Array(['id'=>$course_id, 'course_number'=>$course_number,'name'=>$course_name, 'description'=>$course_description, 'img'=>$course_image, 'is_deleted'=>$course_deleted]);
        $instance->insertToDBToEdit("courses",$data);
        return true;
      }else{
        echo " this course doesnt exist";
        return false;
      }
    }
//////////////////////////////////////////////////////////



    public function delete_course($id){

    }
  }

<?php View::render('headerView',4);?>



<div class="root-container">



<div class="list-container">
  <h2>Courses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="link-button" href="/home/courses/courseRegister">Add </a> </h2>
   <ul>
   <?php
      if($data['course_list']){
      View::render('courseListView', $data['course_list']);
    } else{echo "<br><br><br><br>no courses are available yet...";}
  ?>
  </ul>
</div><!-- course list container-->
<div class="list-container">
  <h2>Students:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="link-button" href="/home/students/studentRegister">Add </a></h2>
   <ul>
     <?php
     if($data['students_list']){
      View::render('studentListView', $data['students_list']);
    } else{echo "<br><br><br><br>no students registered yet...";}
      ?>
   </ul>
</div><!-- students list -->
<div class="main-container">
 <?php
    if($_POST['main_container_view']=='View'){
    View::render('allCoursesCountView', $data['courses_count']);
    View::render('allStudentsCountView', $data['students_count']);

    }else{
  //var_dump($data);
       View::render($_POST['main_container_view'],$data);} ?>




</div><!-- main container -->

</div> <!-- entire page root container-->
<?php  View::render('footerView',2); ?>

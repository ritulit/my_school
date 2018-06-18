<?php View::render('headerView',4);?>


<header>

<nav>
  <div class="nav-bar">
    <a href="home/courses/courseRegister">Add new course</a>
  <a href="#">Logo</a> |
   <a href="#">School</a> |
   <a href="#">Administration</a> |
   <a href="#">Logout</a><img class="avatar" src="/img/administrator.jpg" alt="admin image" >
 </div>
</nav>

</header>

<div class="root-container">



<div class="list-container">
  <h2>Courses: </h2>
   <ul>
   <?php

      View::render('courseListView', $data['course_list']);

  ?>
  </ul>
</div><!-- course list container-->
<div class="list-container">
  <h2>Students:</h2>
   <ul>
     <?php  ?>
   </ul>
</div><!-- students list -->
<div class="main-container">
  <h2>Main container:</h2>

 <?php


    if($_POST['main_container_view']=='View'){
    View::render('allCoursesCountView', $data['courses_count']);
    }
    else{ View::render($_POST['main_container_view'],$data);}
    //  echo "succes factor is ". $_POST['success'];


       ?>

</div><!-- students list -->

</div> <!-- entire page root container-->
<?php  View::render('footerView',2); ?>

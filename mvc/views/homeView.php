<?php View::render('headerView',4);?>


<header>

<nav>
  <div class="nav-bar">

  <a href="/home/">Logo</a> |
   <a href="/home/">School</a> |
   <a href="/administration/">Administration</a> |
   <a href="#">Logout</a><img class="avatar" src="/img/administrator.jpg" alt="admin image" >
 </div>
</nav>

</header>

<div class="root-container">



<div class="list-container">
  <h2>Courses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="link-button" href="/home/courses/courseRegister">Add </a> </h2>
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

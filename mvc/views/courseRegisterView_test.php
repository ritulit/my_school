<?php View::render('headerView',4);?>


<header>

<nav>
  <div class="nav-bar">
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
<p>  Here I will put the default display of student count and courses count </p>
 <?php

    //  View::render('courseRegisterView',$data);

    foreach($data as $value){

      echo $value;} ?>

  <form action="courses/courseRegister" method="post" enctype="multipart/form-data" >
   <div id="course_general_err" class="regErrorMessage"></div><br>
   <div class="display-bar"><input type="text" id="course_name" name="course_name"  placeholder="insert course name" value="<?php echo $_POST['course_name'] ?>"></div>
   <div id="course_name_err" class="regErrorMessage"></div><br>
   <div class="display-bar"><input type="text" id="course_number" name="course_number"  placeholder="insert number" value="<?php echo $_POST['course_number'] ?>"></div><div id="course_number_err" class="regErrorMessage"></div><br>
   <div class="display-bar"><textarea id="course_description" name="course_description"  placeholder="insert description"  rows="10" cols="50"><?php echo htmlspecialchars($_POST['course_description']); ?></textarea></div><div id="course_description_err" class="regErrorMessage"></div><br>
   <div class="display-bar"><input type="file" id="course_image" name="course_image" accept="image/*" ></div><div id="course_image_err" class="regErrorMessage"></div>
   <input type="hidden" name="submitted" value="submitted">
   <input  type="submit" value="send">
   <div id="course_success_msg" class="regSuccessMsg"></div>


       ?>

</div><!-- students list -->

</div> <!-- entire page root container-->
<?php  View::render('footerView',2); ?>

<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>



  <h2>Add a new course:</h2>
      <div>
        <?php

       foreach($_POST['course_register_errors'] as $value){

          echo $value."<br>";} ?>

      <form action="" method="post" enctype="multipart/form-data" >
       <div class="display-bar"><input type="text" id="course_name" name="course_name"  placeholder="insert course name" value="<?php echo $_POST['course_name'] ?>"></div>
       <div class="display-bar"><input type="text" id="course_number" name="course_number"  placeholder="insert number" value="<?php echo $_POST['course_number'] ?>"></div><div id="course_number_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><textarea id="course_description" name="course_description"  placeholder="insert description"  rows="5" cols="21"><?php echo htmlspecialchars($_POST['course_description']); ?></textarea></div><div id="course_description_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="file" id="course_image" name="course_image" accept="image/*" ></div><div id="course_image_err" class="regErrorMessage"></div>
       <input type="hidden" name="submitted" value="submitted">
       <input  type="submit" value="save">
       <div id="course_success_msg" class="regSuccessMsg"></div>





      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

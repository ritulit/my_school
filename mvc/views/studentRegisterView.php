
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>



  <h2>Add a new student:</h2>
      <div>
        <?php
      //  var_dump($_POST);
       foreach($_POST['student_register_errors'] as $value){

          echo $value."<br>";} ?>

      <form action="" method="post" enctype="multipart/form-data" >
       <div id="student_general_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_name" name="student_name"  placeholder="insert student name" value="<?php echo $_POST['student_name'] ?>"></div><div id="student_name_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_phone" name="student_phone"  placeholder="insert phone number" value="<?php echo $_POST['student_phone'] ?>"></div><div id="student_phone_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_email" name="student_email"  placeholder="insert email" value="<?php echo $_POST['student_email'] ?>"></div><div id="student_email_err" class="regErrorMessage"></div><br>
      <p>Upload student's photo:</p>
       <div class="display-bar"><input type="file" id="student_image" name="student_image" accept="image/*" ></div><div id="student_image_err" class="regErrorMessage"></div>
    <br>
      <p>Select the courses for this student's enrollment:</p>


       <?php
       if($data['course_list']){
         echo "<div class=\"display-bar-multi\">";
        foreach($data['course_list'] as $value){
          echo '<div class="cb-div"> <input type="checkbox" name="s_courses[]" value="'.$value['id'].'" ';

          if(in_array($value['id'],$_POST['s_courses'])){echo "checked";}  echo ' > '. ' ' .$value['name']. '  </div>  ';
        }
        echo "</div>";
      } else{echo "<div class=\"display-bar\"><br>no courses are available yet...<div>";} ?>
        <br>
      <input type="hidden" name="submitted" value="submitted">
      <div  class="submit-btn"><input  type="submit" value="save"></div>
      <div id="student_success_msg" class="regSuccessMsg"></div>

      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>


</html>

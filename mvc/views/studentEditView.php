<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

 ?>




      <div>
        <?php
        if(isset($_GET['id']) && empty($data['dynamic_view'])){ ?>

          <h2 class="business-err"> We cannot find the student you requested. please try again.</h2>

      <?php }
      else{ ?>
  <h2>Edit student:</h2>
      <?php  foreach($_POST['student_edit_errors']as $value){

          echo $value."<br>";}

         ?>

         <img class="single-display-avatar" alt="student_image" src=<?php if(!['dynamic_view']['img']){echo $data['dynamic_view']['img'];}else{echo $_POST['img_holder'];}  ?>>

      <form action="" method="post" enctype="multipart/form-data" >
       <div id="student_general_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_name" name="student_name"  placeholder="insert student name" value="<?php echo $data['dynamic_view']['name'] ?>"></div>
       <div id="student_name_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_phone" name="student_phone"  placeholder="insert phone number" value="<?php echo $data['dynamic_view']['phone'] ?>"></div><div id="student_phone_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_email" name="student_email"  placeholder="insert email"  value="<?php echo $data['dynamic_view']['email']; ?>"</div><div id="student_email_err" class="regErrorMessage"></div><br>
       <h4>Replace photo:</h4>
       <div class="display-bar"><input type="file" id="student_image" name="student_image"  accept="image/*" ></div>
       <input type ="hidden" name="img_holder" value=<?php echo $data['dynamic_view']['img']  ?>>
       <input type="hidden" name="submitted" value="submitted">

       <h4>Select to add or remove courses for this student:</h4>


        <?php
        if($data['course_list']){
          echo "<div class=\"display-bar-multi\">";
         foreach($data['course_list'] as $value){
           echo '<div class="cb-div"> <input type="checkbox" name="s_courses[]" value="'.$value['id'].'" ';

           if(in_array($value['id'],$data['dynamic_view']['student_courses_ids'])){echo "checked";}  echo ' > '. ' ' .$value['name']. '  </div>  ';

          }
          echo "</div>";

      }else{ foreach($data['course_list'] as $value){
         echo '<div class="cb-div"> <input type="checkbox" name="s_courses[]" value="'.$value['id'].'" ';
       }} ?>
         <br>

       <input  type="submit" name="edit" value="save">
       <input type="submit" name="delete"  value="delete">
       <div id="student_success_msg" class="regSuccessMsg"></div>






      </form>

<?php } ?>

    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

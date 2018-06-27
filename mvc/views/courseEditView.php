<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>


    <!--<?php //print_r($_POST); ?>-->

  <h2>Edit course:</h2>

      <div>
        <?php

       foreach($_POST['course_edit_errors'] as $value){

          echo $value."<br>";}

           ?>

      <img class="single-display-avatar" alt="course_image" src=<?php if(!['dynamic_view']['img']){echo $data['dynamic_view']['img'];}else{echo $_POST['img_holder'];}  ?>>
      <form action="" method="post" enctype="multipart/form-data" >
       <div id="course_general_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="course_name" name="course_name"  placeholder="insert course name" value="<?php echo $data['dynamic_view']['name'] ?>"></div>
       <div id="course_name_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="course_number" name="course_number"  placeholder="insert number" value="<?php echo $data['dynamic_view']['course_number'] ?>"></div><div id="course_number_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><textarea id="course_description" name="course_description"  placeholder="insert description"  rows="10" cols="50"><?php echo htmlspecialchars($data['dynamic_view']['description']); ?></textarea></div><div id="course_description_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="file" id="course_image"  name="course_image" value="<?php echo array_pop(explode("/",$data['dynamic_view']['img'])) ?>" accept="image/*" ></div><div id="course_image_err" class="regErrorMessage"></div>
       <input type ="hidden" name="img_holder" value=<?php echo $data['dynamic_view']['img']  ?>>
       <input type="hidden" name="submitted" value="submitted">

       <input  type="submit" name="edit" value="save">
       <input type="submit" name="delete"  value="delete">
       <div id="course_success_msg" class="regSuccessMsg"></div>





      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>


<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>

<html>

    <head>
        <title>The school</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/myStyle.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"  />
    </head>

    <body>


  <h2>Add a new student:</h2>
      <div>
        <?php

       foreach($_POST['student_register_errors'] as $value){

          echo $value."<br>";} ?>

      <form action="" method="post" enctype="multipart/form-data" >
       <div id="student_general_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_name" name="student_name"  placeholder="insert student name" value="<?php echo $_POST['student_name'] ?>"></div><div id="student_name_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_phone" name="student_phone"  placeholder="insert phone number" value="<?php echo $_POST['student_phone'] ?>"></div><div id="student_phone_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="student_email" name="student_email"  placeholder="insert email" value="<?php echo $_POST['student_email'] ?>"></div><div id="student_email_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="file" id="student_image" name="student_image" accept="image/*" ></div><div id="student_image_err" class="regErrorMessage"></div>
       <input type="hidden" name="submitted" value="submitted">
       <input  type="submit" value="save">
       <div id="student_success_msg" class="regSuccessMsg"></div>





      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

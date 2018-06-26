
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


  <h2>Add a new manager:</h2>
      <div>
        <?php
        //var_dump($data['dynamic_view']);

       foreach($_POST['manager_register_errors'] as $value){

          echo $value."<br>";} ?>

      <form action="" method="post" enctype="multipart/form-data" >
       <div id="manager_general_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="manager_name" name="manager_name"  placeholder="insert manager name" value="<?php echo $_POST['manager_name'] ?>"></div><div id="manager_name_err" class="regErrorMessage"></div><br>
       <div class="display-bar">
   <select name="manager_role">
     <option  value="">Select role:</option>
     <option id="manager_role_owner" value="1"  <?php if($_POST['manager_role']==1){echo "selected";} ?>>Owner</option>
     <option id="manager_role_manager" value="2"  <?php if($_POST['manager_role']==2){echo "selected";}  ?>>Manager</option>
     <option id="manager_role_sales" value="3"  <?php if($_POST['manager_role']==3){echo "selected";}  ?>>Sales</option>

   </select>
 </div>

       <div class="display-bar"><input type="text" id="manager_phone" name="manager_phone"  placeholder="insert phone number" value="<?php echo $_POST['manager_phone'] ?>"></div><div id="manager_phone_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="manager_email" name="manager_email"  placeholder="insert email" value="<?php echo $_POST['manager_email'] ?>"></div><div id="manager_email_err" class="regErrorMessage"></div><br>

       <div class="display-bar"><input type="password" id="manager_password" name="manager_password"  placeholder="insert password" ></div><div id="manager_password_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="password" id="manager_password_retype" name="manager_password_retype"  placeholder="retype password" ></div><div id="manager_password_match_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="file" id="manager_image" name="manager_image" accept="image/*" ></div><div id="manager_image_err" class="regErrorMessage"></div>
       <input type="hidden" name="submitted" value="submitted">
       <input  type="submit" value="save">
       <div id="student_success_msg" class="regSuccessMsg"></div>





      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

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

    <!--<?php //print_r($_POST); ?>-->

  <h2>Edit manager:</h2>

      <div>
        <?php

    //  var_dump($data);
       foreach($_POST['manager_edit_errors'] as $value){

          echo $value."<br>";}


           ?>

      <img class="single-display-avatar" alt="manager_image" src=<?php if(!['dynamic_view']['img']){echo $data['dynamic_view']['img'];}else{echo $_POST['img_holder'];}  ?>>

      <form action="" method="post" enctype="multipart/form-data" >
       <div id="manager_general_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="manager_name" name="manager_name"  placeholder="insert manager name" value="<?php echo $data['dynamic_view']['name'] ?>"></div>
       <div class="display-bar">
        <select name="manager_role">
        <option  value="">Select role:</option>
        <option id="manager_role_owner" value="1"  <?php if( $data['dynamic_view']['role']==1){echo "selected";} ?>>Owner</option>
        <option id="manager_role_manager" value="2"  <?php if( $data['dynamic_view']['role']==2){echo "selected";}  ?>>Manager</option>
        <option id="manager_role_sales" value="3"  <?php if( $data['dynamic_view']['role']==3){echo "selected";}  ?>>Sales</option>
       </select>
       </div>
       <div class="display-bar"><input type="text" id="manager_phone" name="manager_phone"  placeholder="insert phone number" value="<?php echo $data['dynamic_view']['phone'] ?>"></div><div id="manager_phone_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="text" id="manager_email" name="manager_email"  placeholder="insert email"  value="<?php echo $data['dynamic_view']['email']; ?>"</div><div id="manager_email_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="file" id="manager_image" name="manager_image" accept="image/*" ></div><div id="manager_image_err" class="regErrorMessage"></div><br><br><br>

       To change password:
       <div class="display-bar"><input type="password" id="original_manager_password" name="original_manager_password"  placeholder="insert current password" value="<?php echo $_POST['original_manager_password'] ?>"></div><div id="manager_password_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="password" id="manager_password" name="manager_password"  placeholder="insert new password" value="<?php echo $_POST['manager_password'] ?>"></div><div id="manager_password_err" class="regErrorMessage"></div><br>
       <div class="display-bar"><input type="password" id="manager_password_retype" name="manager_password_retype"  placeholder="retype new password" value="<?php echo $_POST['manager_password_retype'] ?>"></div><div id="manager_password_match_err" class="regErrorMessage"></div><br><br>

       <input type ="hidden" name="img_holder" value=<?php echo $data['dynamic_view']['img']  ?>>
       <input type="hidden" name="submitted" value="submitted">

       <input  type="submit" name="edit" value="save">
       <input type="submit" name="delete"  value="delete">
       <div id="manager_success_msg" class="regSuccessMsg"></div>






      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

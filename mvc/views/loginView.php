<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>



  <h2>Please provide login credentials:</h2>
      <div>
        <?php
//var_dump($_POST);
       foreach($_POST['login_errors'] as $value){

          echo $value."<br>";} ?>

      <form class="login-form" action="" method="post" enctype="multipart/form-data" >

       <div class="display-bar"><input type="text" id="email" name="email"  placeholder="insert your email" value="<?php echo $_POST['email'] ?>"></div>
       <div class="display-bar"><input type="password" id="password" name="password"  placeholder="insert password" </div><br>
       <input type="hidden" name="submitted" value="submitted">
        <div class="display-bar "><input class="submit-btn"  type="submit" value="login"></div>





      </form>



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

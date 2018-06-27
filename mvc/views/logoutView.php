<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
 ?>



  <h2>You are logged out .</h2>
      <div>
        <?php

       foreach($_POST['logout_errors'] as $value){

          echo $value."<br>";} ?>

    <h3>To login again click <a href="/auth/login">here</a></h3>  



    </div>
    <!--  <script type="text/javascript" src="js/courseRegister.js" >  </script>  -->



   </body>

</html>

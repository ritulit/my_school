<?php View::render('headerView',4);?>



<div class="root-container">

  <div class="auth-container">
   <?php

      if($_POST['auth_container_view']=='View'){

          echo "no view here"
;
    }else{
      View::render($_POST['auth_container_view'],$data);} ?>




  </div><!-- auth container -->


</div> <!-- entire page root container-->
<?php  View::render('footerView',2); ?>

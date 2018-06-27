<?php View::render('headerView',4);?>


<div class="root-container">

  <div class="ghost-list-container">
    <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </h2>
     <ul>
     <?php
        if($data['managers_list']){
        View::render('managersListView', $data['managers_list']);
      } else{echo "<br><br><br><br>no managers are listed yet...";}
    ?>
    </ul>
  </div><!-- course list container-->


<div class="list-container">
  <h2>Administrators:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="link-button" href="/administration/managers/managerRegister">Add </a> </h2>
   <ul>
   <?php
      if($data['managers_list']){
      View::render('managersListView', $data['managers_list']);
    } else{echo "<br><br><br><br>no managers are listed yet...";}
  ?>
  </ul>
</div><!-- course list container-->

<div class="main-container">


 <?php


    if($_POST['main_container_view']=='View'){
    View::render('allManagersCountView', $data['managers_count']);



    }
    else{ View::render($_POST['main_container_view'],$data);}
    //  echo "succes factor is ". $_POST['success'];


       ?>

</div><!-- students list -->

</div> <!-- entire page root container-->
<?php  View::render('footerView',2); ?>

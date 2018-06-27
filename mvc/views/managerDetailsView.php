
  <div >



   <?php


   if(!isset($_GET['id'])){ ?>
    <h2 class="business-err"> Something is wrong with your request. Please add filters to search by. </h2>
   <?php }
   if(isset($_GET['id']) && !empty($data['dynamic_view'])){

   ?>

    	<h2 class="display-bar">Manager details:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   <a class="link-button" href="/administration/managers/managerEdit?id=<?php echo $data['dynamic_view']['id'] ?>" >Edit</a></h2><br>
      <div class="display-bar"> <img class="single-display-avatar" alt="admin_image" src= <?php echo $data['dynamic_view']['img']?>> <h3><?php echo $data['dynamic_view']['name']; ?></h3>   </div><br>
      <div class="display-bar">Phone number: <?php echo $data['dynamic_view']['phone']; ?></div><br>
    	<div class="display-bar">Email : <?php echo $data['dynamic_view']['email']; ?></div><br>
      <div class="display-bar">Role : <?php echo $data['dynamic_view']['role_name']; ?></div><br>

    <!--	<div class="display-bar">Current enrolled students : <?php// echo (implode(", ",$data['students'])); ?></div><br>-->
    <?php }

    if(isset($_GET['id']) && empty($data['dynamic_view'])){ ?>

      <h2 class="business-err"> We cannot find the student you requested. please try again.</h2>
     <?php } ?>


  </div>

</body>

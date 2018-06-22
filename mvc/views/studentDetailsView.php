
<head>
    <title>The school</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/myStyle.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"  />
</head>
<body>

  <div >



   <?php


   if(!isset($_GET['id'])){ ?>
    <h2 class="business-err"> Something is wrong with your request. Please add filters to search by. </h2>
   <?php }
   if(isset($_GET['id']) && !empty($data['dynamic_view'])){

   ?>

    	<h2 class="display-bar">Student details:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   <a class="link-button" href="/home/students/studentEdit?id=<?php echo $data['dynamic_view']['id'] ?>" >Edit</a></h2><br>
      <div class="display-bar"> <img class="single-display-avatar" alt="student_image" src= <?php echo $data['dynamic_view']['img']?>> <h3><?php echo $data['dynamic_view']['name']; ?></h3>   </div><br>
      <div class="display-bar">Phone number: <?php echo $data['dynamic_view']['phone']; ?></div><br>
    	<div class="display-bar">Email : <?php echo $data['dynamic_view']['email']; ?></div><br>

    <!--	<div class="display-bar">Current enrolled students : <?php// echo (implode(", ",$data['students'])); ?></div><br>-->
    <?php }

    if(isset($_GET['id']) && empty($data['dynamic_view'])){ ?>

      <h2 class="business-err"> We cannot find the student you requested. please try again.</h2>
     <?php } ?>


  </div>

</body>

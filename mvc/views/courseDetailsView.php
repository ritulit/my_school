
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
     //echo ($data['course_details']);
   ?>

    	<h2 class="display-bar">Course details:</h2><br>
      <div class="display-bar"> <img class="single-display-avatar" alt="course_image" src= <?php echo $data['dynamic_view']['img']?>> <h3><?php echo $data['dynamic_view']['name']; ?></h3>   </div><br>
      <div class="display-bar">Course number: <?php echo $data['dynamic_view']['course_number']; ?></div><br>
    	<div class="display-bar">Description : <?php echo $data['dynamic_view']['description']; ?></div><br>

    <!--	<div class="display-bar">Current enrolled students : <?php// echo (implode(", ",$data['students'])); ?></div><br>-->
    <?php }

    if(isset($_GET['id']) && empty($data['dynamic_view'])){ ?>

      <h2 class="business-err"> We cannot find the course you requested. please try again.</h2>
     <?php } ?>


  </div>

</body>

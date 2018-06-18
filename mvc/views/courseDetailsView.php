
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
   elseif(isset($_GET['id']) && !empty($data)){
   ?>

    	<h2 class="display-bar">Course details:</h2><br>
      <div class="display-bar"> <img class="avatar" alt="course_image" src= <?php echo $data['img']?>><?php echo $data['name']; ?>   </div><br>
      <div class="display-bar">Course number: <?php echo $data['course_number']; ?></div><br>
    	<div class="display-bar">Description : <?php echo $data['description']; ?></div><br>

    <!--	<div class="display-bar">Current enrolled students : <?php echo (implode(", ",$data['students'])); ?></div><br>-->
    <?php }

    elseif(isset($_GET['id']) && empty($data)){ ?>

      <h2 class="business-err"> We cannot find the course you requested. please try again.</h2>
     <?php } ?>


  </div>

</body>

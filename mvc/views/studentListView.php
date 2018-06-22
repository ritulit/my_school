<?php

foreach($data as $value){
  echo "<li><img class=\"avatar\" alt=\"student_image\" src=\"".$value['img']."\">  "  ."  <a href=\"/home/students/studentDetails?id=".$value['id']."\">" . $value['name'] .  "</a></li><br>";
}
?>

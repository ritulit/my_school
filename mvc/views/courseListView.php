





<?php
foreach($data as $value){
  echo "<li><img class=\"avatar\" alt=\"course_image\" src=\"".$value['img']."\">  "  ."  <a href=\"home/courses/courseDetails?id=".$value['id']."\">" . $value['name'] .  "</a></li><br>";
}
?>

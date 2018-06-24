<?php

foreach($data as $value){
  echo "<li><img class=\"avatar\" alt=\"student_image\" src=\"".$value['img']."\">  "  ."  <a href=\"/administration/managers/managerDetails?id=".$value['id']."\">" . $value['name'] .  "</a></li><br>";
}
?>

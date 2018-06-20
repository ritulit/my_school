<?php
Interface database{

  public function insertToDB($dest , $content);

  public function deleteFromDB($source, $condition);

  public function editFromDB($source, $data, $condition);

}






?>

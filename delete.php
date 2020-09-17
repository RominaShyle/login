<?php

require_once "includes/db.php";
$id = $_POST['id'];

if(empty($id)){
  die;
}

$sql = $conn->prepare("DELETE FROM books where id = ?");
$sql->bind_param("i", $id);
$result=$sql->execute();

if($result){
  echo '<div class= "col-md-offset-4 col-md-5 text-center alert alert-success">
  ! Record was deleted! </div>';
}
else{

  die('Connection error!');
}
$sql->close();
$conn->close();


 ?>

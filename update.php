<?php
require_once "includes/db.php";

$id = $_POST['id'];
$author = $_POST['author'];
$title = $_POST['title'];
$publisher = $_POST['publisher'];

if(!empty($title) && !empty($author) && !empty($publisher) && !empty($id)){

  $sql = "UPDATE books SET title = '$title', author = '$author', publisher = '$publisher' WHERE id = '$id'";
  if($conn->query($sql)){
    echo '<div class = "col-md-offset-4 col-md-5 text-center alert alert-success"> 1 Record updated! </div>';

  }


}else {
  echo '<div class = "col-md-offset-4 col-md-5 text-center alert alert-danger">Error while updating </div>';
}



 ?>

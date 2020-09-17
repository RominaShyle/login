<?php

require_once "includes/db.php";

$author = $_POST['author'];
$title = $_POST['title'];
$publisher = $_POST['publisher'];


if(!empty($author) && !empty($title) && !empty($publisher)){

  $sql = $conn->prepare("INSERT INTO books (author, title, publisher) VALUES ( ?, ?, ?)");
  $sql->bind_param("sss", $author, $title, $publisher);
  $sql->execute();
  $sql->close();
  $conn->close();
}else

echo ''

 ?>

<?php

session_start();


if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false){
  header('location: login.php');
  exit;
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <title>Books</title>
  </head>

  <?php
  require_once 'includes/nav_bar.php'; ?>
  <body>
    <div class="container-fluid">
      <div class="jumbotron m-5">
          <h1 class="text-center"> MY BOOKS </h1>
      </div>

    </div>


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="pull-right">
            <button class="btn btn-success" id="show_add" style="float:right"> Add a New Book</button>
          </div>
<div class="form-inline" id="link_add">

  <div class="form-group col-md-3">
    <input type="text" name="title" value="" id="title" placeholder="Title" class="form-control" required>

  </div>

  <div class="form-group col-md-3">
    <input type="text" name="author" value="" id= "author" placeholder="Author" class="form-control" required>

  </div>
  <div class="form-group col-md-3">
    <input type="text" name="publisher" value="" id="publisher" placeholder="Publisher" class="form-control" required>

  </div>

  <div class="form-group col-md-3">
<button type="button" name="add" class="btn btn-outline-success mx-3 px-4" id="add_new"> Add</button>
 <button type="button" name="add" class="btn btn-outline-danger" href="javascript:void(0);" id="cancel"
 onclick="$('#link_add').slideUp(500); $('#show_add').show(500);"> Cancel</button>
 </div>
</div>

        </div>

      </div>

<div class="row">
<div class="col-md-12">
  <div class="" id="records_content">
    <!-- KJO DO MANIPULOHET ME ANE TE JAVASCRIPT DOM-->
  </div>

  <br>
  <div class="col-md-offset-1 col-md-10" id="table_content">

  </div>
</div>
</div>
    </div>


<script type="text/javascript" src="scripts/app.js">

</script>
  </body>
</html>

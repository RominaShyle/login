<?php


require_once "db.php";


//Deklarojme variablat dhe i inicializojme si stringje bosh

$name = $lname = $email = $password = '';
$name_err = $lname_err = $email_err = $password_err = '';



if($_SERVER['REQUEST_METHOD'] == 'POST'){

if(empty(trim($_POST['name']))){

  $name_err = "*Please enter name.";
}else{
  $name = trim($_POST['name']);

}



if(empty(trim($_POST['lname']))){

  $lname_err = "*Please enter your last name.";
}else{
  $lname  = trim($_POST['lname']);

}



if(empty(trim($_POST['email']))){

  $email_err = "*Please enter email.";
}else
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  $email_err = "*Please enter email in the correct format.";
}else {

$sql = "SELECT id FROM users where email = ?";

if($stmt = $conn->prepare($sql)){
$email_ = trim($_POST['email']);
  $stmt->bind_param("s", $email_ );

if($stmt->execute()){

  $stmt->store_result();
if($stmt->num_rows > 0){

  $email_err = "This email is taken.";
}
else {
  $email = trim($_POST['email']);
}

}else { die("Ka ndodhur nje error!"); }


}else { die("Ka ndodhur nje error!");}

$stmt->close();
}


if(empty(trim($_POST['password']))){

  $password_err = "*Please enter a password.";
}
elseif (strlen(trim($_POST['password'])) < 5) {
    $password_err = "*Password must have at least 5 characters!";
}
else{
  $password = trim($_POST['password']);

}

if(empty($name_err) && empty($lname_err) && empty($email_err) && empty($password_err)){

  $sql = "INSERT INTO users (name, last_name, email, password) VALUES (?, ?, ?, ?)";

if($stmt = $conn->prepare($sql)){


  $stmt->bind_param("ssss", $param_name, $param_lname, $param_email, $param_password);

  $param_name = $name;
  $param_lname = $lname;
  $param_email = $email_;
  $param_password = password_hash($password, PASSWORD_DEFAULT);

  if ($stmt->execute()) {
    header('location: login.php');
  }else {
    echo "Could not create a new user!";
  }

  $stmt->close();


}
}

$conn->close();


}





 ?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <meta charset="utf-8">
    <title>Sign up</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </head>
  <style media="screen">
    .error{
      color:red
    }
  </style>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
<img src="images/foto1.png" alt="foto" style="max-width: 35px;">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>

      </div>
    </nav>
<div class="container my-4">

<h2> Sign up</h2>
<p>Please fill this form to create an account. </p>

<div class="row">


  <div class="col-md-6">
    <form class="border p-3 " action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="your name..." required>
    <span class="error"> <?php echo $name_err; ?></span>
    </div>


    <div class="form-group">
      <label for="lname">Last name</label>
      <input  class="form-control" type="text" name="lname" id="lname" value="<?php echo $lname; ?>" placeholder="your last name..." required>
    <span class="error"> <?php echo $lname_err; ?></span>
    </div>


    <div class="form-group">
      <label for="email">E-mail</label>
      <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="your email..." required>
    <span class="error"> <?php echo $email_err; ?></span>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control"  type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder="your password..." required>
    <span class="error"> <?php echo $password_err; ?></span>
    </div>

    <div class="form-group">

      <button type="submit" name="submit" class="btn btn-success"> Submit</button>

    </div>
    <p> Already have an account?<a target="_blank" href="login.php">  Login here</a> </p>

    </form>

  </div>
  <div class="col-md-3">

  </div>
  <div class="col-md-3">

  </div>

</div>


</div>


  </body>
</html>

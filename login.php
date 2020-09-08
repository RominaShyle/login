

<?php

require_once "includes/db.php";
/*

echo "<pre>";
var_dump($_POST);
echo "<pre>";

*/

$email_err = $password_err = '';
$email = $password = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty(trim($_POST['email']))){

      $email_err = "*E-mail can't be empty.";

      }
      else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email_err = "*Please enter email in the correct format.";
            }
            else{
                    $email = trim($_POST['email']);
            }






      if(empty(trim($_POST['password']))){
          $password_err = 'Please enter a password.';
        }else { $password = trim($_POST['password']);}


        if(empty($email_err) && empty($password_err)){

          $sql = 'SELECT id, email, password FROM users WHERE email = ?';

          if($stmt = $conn->prepare($sql)){

            $stmt->bind_param('s', $param_email);

          $param_email = $email;

            if($stmt->execute()){

              $stmt->store_result();

              if($stmt->num_rows == 1){
$stmt->bind_result($id, $email, $hashed_password);

if($stmt->fetch()){

  if(password_verify($password, $hashed_password)){

    session_start();
  echo "logged in";

  $_SESSION['logged_in'] = true;
  $_SESSION['email'] = $email;

  header('location: home.php');

  }else

  die('the password was not correct');
}

              }
            }



          }

        }






}
 ?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <meta charset="utf-8">
    <title>Login</title>
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
    <?php require_once('includes/nav_bar.php'); ?>

<div class="container my-4">

<h2> Log in</h2>
<p>Please fill this form to log into your account. </p>

<div class="row">


  <div class="col-md-6">
    <form class="border p-3 " action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

    <div class="form-group">
      <label for="email">E-mail</label>
      <input class="form-control" type="text" name="email" id="email" value="" placeholder="your email..." required>
    <span class="error"> <?php echo $email_err; ?></span>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control"  type="password" name="password" id="password" value="" placeholder="your password..." required>
    <span class="error"><?php echo $password_err; ?> </span>
    </div>

    <div class="form-group">

      <button type="submit" name="submit" class="btn btn-success"> Submit</button>

    </div>
    <p> You're not registered? <a href="signup.php"> Create an account</a> </p>

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

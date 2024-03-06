<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php include('./partials/navbar.php') ?>
    
    <?php

$showAlert = false;
$showError = false;
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dataBase = 'code-with-harry';

$connection = mysqli_connect($serverName, $userName, $password, $dataBase);
if (!$connection) {
    echo ('Connection is not successful');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

        $sql = "SELECT * FROM `login-system` WHERE `name` = '$name'";
        $result = mysqli_query($connection, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
          while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
              $showAlert = true;
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $name;
              header('location: welcome.php');
            }else{
              $showError = true;
          }
          }
          
        }else{
            $showError = true;
        }
    

    if($showAlert){
      echo '<div class="alert alert-success">loggedIn Credentials</div>';

    }
   if($showError){
    echo '<div class="alert alert-danger">Invalid Credentials</div>';

   }
}
?>



<div class="container">
    <h2>Login Here</h2>
    <div class="row">
    <div class="col-md-6">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
    
    <label for="Name">Name</label>
    <input type="text" class="form-control" name="name"/>

    <label for="password">Password</label>
    <input type="password" class="form-control" name="password"/>

    <button class="btn btn-primary mt-2" type="submit">Submit</button>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>


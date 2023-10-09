<?php
session_start();
include  'conn.php';
if (!isset($_SESSION["login_username"])) {
  header("Location: signup.php");
  exit();
}


$username =$_SESSION["login_username"];


?>
<html>
<head>
  <title> homepage </title>
</head>
<body>
  <h1> Home Page </h1>
  <br>
  <br>
  <hr>
  <h3> <?php echo $username; ?></h3>
  <p> This is your homepage </p>
  <br>
  <a href="signup.php">Logout </a>

</body>
</html>

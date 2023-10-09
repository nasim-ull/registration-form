SIGNUP.PHP
<?php
include  'conn.php';
?>

<html>
<head>
    <title>Registration Form</title>
</head>
<body>
  <h2>Registration Form</h2>




  <form action="" method="POST">

    Username: <input type="text" name="username" placeholder="Type username"required><br>

    Password: <input type="password" name="password" placeholder="Type password"required><br>

    <input type="submit" name="register">
  </form>




<?php
if (isset($_POST['register'])){
  if (isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $salt = "sausage";
    $hash_password = hash("sha256",$password. $salt);


    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
    if ($conn->query($sql) == TRUE){
      echo "Registration Successful";
    }
  }
}





?>
<br>
<br>
<br>

<h1> Login</h1>
<form action="" method="POST">
  <label> username: </label>
  <input type="text" name="login_username" placeholder="Please type a username" required> <br>
  <label> password: </label>
  <input type="password" name="login_password" placeholder="Please type a password" required> <br>
  <input type="submit" name="login">
</form>



<?php

session_start();
if (isset($_POST['login'])){
  if (isset($_POST['login_username']) && isset($_POST['login_password'])){
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    $salt = 'sausage';
    $hash_password = hash('sha256', $login_password . $salt);

    $query = "SELECT * FROM users WHERE username = '$login_username' AND password = '$hash_password'";
    $result = $conn->query($query);

    if ($result->num_rows === 1){
      $row = $result->fetch_assoc();
      if ($login_username === 'admin'){
        header('Location: admin.php');
          $_SESSION['login_username'] = $login_username;
        exit();
      } else {
        header('Location: index.php');
        $_SESSION['login_username'] = $login_username;
      }

    }
    else {
      echo "Invalid Details, please try again.";
    }
  }
}







 ?>




</body>
</html>

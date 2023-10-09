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
    <title>Admin</title>
</head>
<body>
    <h1>Welcome to the Admin Panel</h1>
    <h3> <?php echo $username; ?></h3>
    <br>
    <h2>User List</h2>
    <table>
        <thead>
            <tr>
                <th>Usernames</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT username FROM users";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $email = $row['username'];
                echo "<tr>";
                echo "<td>$email</td>";
                echo "<td><a href='admin.php?delete=$email'>Delete</a></td>";
                echo "</tr>";
            }


            if (isset($_GET['delete'])) {
                $usernameToDelete = $_GET['delete'];

                $sql = "DELETE FROM users WHERE username = '$usernameToDelete'";
                if ($conn->query($sql) === TRUE) {
                    echo "User with email '$usernameToDelete' has been deleted.";
                } else {
                    echo "Error deleting user: " . $conn->error;
                }
            }
?>
        </tbody>
    </table>
      <a href="signup.php">Logout</a>
</body>
</html>

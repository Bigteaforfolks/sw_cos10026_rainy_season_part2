<?php
session_start();
require_once("settings.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $pw = $_POST['password'];

  $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $query->bind_param("s", $username);
  $query->execute();
  $result = $query->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($pw, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    header("Location: manage.php");
    mysqli_close($conn);
    exit();
  } else {
    echo "Incorrect username or password.";
  }
} else {
  // if no post method detected, redirect to login page
  header("Location: login.php");

}
?>
<?php
session_start();
require_once("settings.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $pw = $_POST['password'];

  $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $query->bind_param("ss", $username, $pw);
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
  // if no post method detected, deny user access
  echo "<h3>Login failed</h3>";
  echo "<p>Return to <a href='login.php'>Login</a> and try again.</p>";
}
?>
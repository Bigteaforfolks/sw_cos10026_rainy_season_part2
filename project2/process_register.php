<?php
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if ($username === '' || $password === '' || $confirm_password === '') {
    echo "Error: All fields are required.";
    echo "<br><a href='register.php'>Back to register</a>";
    exit;
}

if ($password !== $confirm_password) {
    echo "Error: Passwords do not match.";
    echo "<br><a href='register.php'>Back to register</a>";
    exit;
}

# AI assisted content 
# Prompt: How can I check for duplicate usernames in the table?
$username_safe = mysqli_real_escape_string($conn, $username);
$query = "SELECT * FROM users WHERE username = '$username_safe'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Username already exists.";
    echo "<br><a href='register.php'>Back to register</a>";
    mysqli_close($conn);
    exit;
}
# End of AI assisted content

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "Registration successful.";
    echo "<br><a href='login.php'>Go to login</a>";
} else {
    echo "Registration failed.";
    echo "<br><a href='register.php'>Back to register</a>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
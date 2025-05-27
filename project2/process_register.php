<?php
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

echo "<link href='styles/styles.css' rel='stylesheet'>";

if ($username === '' || $password === '' || $confirm_password === '') {
    include "header.inc";
    include "description_error.inc";   
    echo "<div class='msg'>";
        echo "<p>Error: All fields are required.</p>";
        echo "<br><p><a href='register.php'>Back to register</a></p>";
    echo "</div>";
    include "footer.inc";
    exit;
}

if ($password !== $confirm_password) {
    include "header.inc";
    include "description_error.inc";
    echo "<div class='msg'>";
        echo "<p>Error: Passwords do not match.</p>";
        echo "<br><p><a href='register.php'>Back to register</a></p>";
    echo "</div>";
    include "footer.inc";
    exit;
}

# AI assisted content 
# Prompt: How can I check for duplicate usernames in the table?
$username_safe = mysqli_real_escape_string($conn, $username);
$query = "SELECT * FROM users WHERE username = '$username_safe'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    include "header.inc";
    include "description_error.inc";
    echo "<div class='msg'>";
        echo "<p>Username already exists.</p>";
        echo "<br><p><a href='register.php'>Back to register</a></p>";
    echo "</div>";
    include "footer.inc";
    mysqli_close($conn);
    exit;
}
# End of AI assisted content

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    include "header.inc";
    echo "<div class='msg'>";
        echo "<p>Registration successful.</p>";
        echo "<br><p><a href='login.php'>Go to login</a></p>";
    echo "</div>";
    include "footer.inc";
} else {
    include "header.inc";
    echo "<div class='msg'>";
        echo "<p>Registration failed.</p>";
        echo "<br><p><a href='register.php'>Back to register</a></p>";
    echo "</div>";
    include "footer.inc";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
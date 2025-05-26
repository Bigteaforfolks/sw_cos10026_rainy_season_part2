<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>

    <?php
        include 'header.inc';
    ?>

    <!-- Information about the page -->
    <section class="description">
        <h2>Login</h2>
    </section>

    <form method="POST" action="process_login.php">
        <label class="user">Username: </label>
        <input type="text" id="username" name="username" required>

        <label class="pass">Password: </label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Log in">
    </form>

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
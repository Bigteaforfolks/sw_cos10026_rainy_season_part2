<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>

    <?php
        include 'header.inc';
    ?>

    <!-- Information about the page -->
    <section class="description">
        <h2>Register new admin</h2>
    </section>

    <form method="POST" action="process_register.php">
        <div>
            <label class="user">Username: </label>
            <input type="text" id="username" name="username" autocomplete="off" required>
        </div>

        <div>
            <label class="pass">Password: </label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label class="pass">Confirm Password: </label>
            <input type="password" id="password" name="password" required>
        </div>

        <input type="submit" value="Register">
    </form>

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
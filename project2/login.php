<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Management Login page of the Rainy Season website.">
    <meta name="keywords" content="Rainy Season, Jobs, Apply, Login, Work, Form">
    <meta name="author" content="Oakley Tang">
    <title>HR Manager Login</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body id="login-page">

    <?php
        include 'header.inc';
    ?>

    <!-- Information about the page -->
    <section class="description">
        <h2>Login</h2>
    </section>

    <div id="form-container">
        <form method="POST" action="process_login.php">
            <div class="form-section">
                <div class="form-group">
                    <div class="form-field">
                        <label for="username" class="form-field__label">Username: </label>
                        <input type="text" id="username" name="username" class="form-field__textbox" autocomplete="off" required>
                    </div>

                    <div class="form-field">
                        <label for="password" class="form-field__label">Password: </label>
                        <input type="password" id="password" name="password" class="form-field__textbox" required>
                    </div>
                </div>

                <div class="form-input">
                    <input type="submit" class="form-button" value="Log in">
                </div>
            </div>
        </form>
    </div>

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
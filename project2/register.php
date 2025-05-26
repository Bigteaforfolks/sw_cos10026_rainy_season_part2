<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Register Page for New User.">
    <meta name="keywords" content="Rainy Season, Jobs, Apply, Application, Work">
    <meta name="author" content="Oakley Tang">
    <title>Register</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body id="register-page">

    <?php
        include 'header.inc';
    ?>

    <!-- Information about the page -->
    <section class="description">
        <h2>Register new admin</h2>
    </section>

    <div id="form-container">
        <div class="form-section">
            <form method="POST" action="process_register.php">
                <div class="form-group">
                    <div class="form-field">
                        <label for="username" class="form-field__label">Username: </label>
                        <input type="text" id="username" name="username" class="form-field__textbox" autocomplete="off" required>
                    </div>

                    <div class="form-field">
                        <label for="password" class="form-field__label">Password: </label>
                        <input type="password" id="password" name="password" class="form-field__textbox" required>
                    </div>

                    <div class="form-field">
                        <label for="confirm_password" class="form-field__label">Confirm Password: </label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-field__textbox" required>
                    </div>
                </div>

                <div class="form-input">
                    <input type="submit" value="Register" class="form-button">
                </div>
            </form>
        </div>
    </div>

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
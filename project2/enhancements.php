<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Enhancements page">
    <meta name="keywords" content="Rainy Season, Enhancements, Information, Info">
    <meta name="author" content="Oakley Tang">
    <title>Enhancements &sol; Rainy Season</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body id="enhancements-page">
    <?php
        include 'header.inc';
    ?>
        
    <section class="description">
        <h2>Enhancements</h2>
    </section>
    
    <!-- Member contribition section -->
    <section id="enhancements">
        <h3>Enhancements made to site</h3>
        
        <!-- Definition list to tie enhancement and description together -->
        <dl>
            <div class="login-page">
                <dt>Access to manage.php restriction</dt>
                <dd>
                    <ul>
                        <li>Created table "users" in database</li>
                        <li>Coded login processing</li>
                        <li>Protected input from SQL injection</li>
                        <li>Checked password against hashed password in database</li>
                    </ul>
                </dd>
            </div>   
        </dl>
    </section>

    <hr class="separator"> 

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
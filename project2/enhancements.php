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
        
        <!-- Definition list to tie member and contribution together -->
        <dl>
            <div class="jacob-contribution">
                <dt>Jacob</dt>
                <dd>
                    <ul>
                        <li>Main page</li>
                        <li>Apply page</li>
                        <li>CSS style file</li>
                        <li>Code comment checking</li>
                        <li>Jira project management</li>
                    </ul>
                </dd>
            </div>

            <div class="oakley-contribution">
                <dt>Oakley</dt>
                <dd>
                    <ul>
                        <li>Jobs page</li>
                        <li>About page</li>
                        <li>CSS style file</li>
                        <li>Accessibility checking</li>
                        <li>Jira project management</li>
                        <li>Site modularisation using PHP and .inc files</li>
                        <li>Conversion of jobs page to  dynamic updating via PHP</li>
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
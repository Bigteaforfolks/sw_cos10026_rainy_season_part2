<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Job Application page of the Rainy Season website.">
    <meta name="keywords" content="Rainy Season, Jobs, Apply, Application, Work, Form">
    <meta name="author" content="Jacob Ang">
    <title>Rainy Season EOI Success Page</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>
<?php

    // include header
    include_once("header.inc");

    // sends user back if not using POST method
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        // database connection
        require_once "settings.php";
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        // database connection success or error
        if ($conn) {

            // create eoi table if not detected (copy of database)
            $create_table_sql = "
            CREATE TABLE IF NOT EXISTS eoi (
                eoi_number int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                job_reference_number varchar(5) NOT NULL,
                first_name varchar(20) NOT NULL,
                last_name varchar(20) NOT NULL,
                date_of_birth varchar(10) NOT NULL,
                gender enum('male','female','other') NOT NULL,
                address_street varchar(40) NOT NULL,
                address_suburb varchar(40) NOT NULL,
                address_state enum('VIC','ACT','NT','NSW','QLD','WA','SA','TAS') NOT NULL,
                address_postcode varchar(4) NOT NULL,
                email_address varchar(50) NOT NULL,
                phone_number varchar(14) NOT NULL,
                skill_wireshark tinyint(1) NOT NULL,
                skill_csharp tinyint(1) NOT NULL,
                skill_jira tinyint(1) NOT NULL,
                skill_github tinyint(1) NOT NULL,
                skill_scriptkiddie tinyint(1) NOT NULL,
                other_skills text NOT NULL,
                eoi_status enum('New','Current','Final') NOT NULL DEFAULT 'New'
            );";

        } else {
            // display connection error
            echo "<h1>Database Connection Error</h1>";
            echo "<p>Unable to connect to database. Error: " . mysqli_connect_error() . "</p>";
        }
    } else {
        // if no post method detected, deny user access
        echo "<h1>Access Denied</h1>";
        echo "<p><a href='apply.php'>Go back to Application Form</a></p>";
    }
    
    // include footer
    include_once("footer.inc");
?>
</body>
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

            // setting eoi data
            $eoi_data = array(
                "job_reference_number" => $_POST["jobreferencenumber"] ?? '',
                "first_name"           => $_POST["firstname"] ?? '',         
                "last_name"            => $_POST["lastname"] ?? '',          
                "date_of_birth"        => $_POST["dateofbirth"] ?? '',       
                "gender"               => $_POST["gender"] ?? null,           
                "address_street"       => $_POST["streetaddress"] ?? '',    
                "address_suburb"       => $_POST["suburb"] ?? '',           
                "address_state"        => $_POST["state"] ?? '',             
                "address_postcode"     => $_POST["postcode"] ?? '',          
                "email_address"        => $_POST["emailaddress"] ?? '',      
                "phone_number"         => $_POST["phonenumber"] ?? '',       
                "skill_wireshark"      => isset($_POST["wireshark"]) ? 1 : 0, 
                "skill_csharp"         => isset($_POST["csharp"]) ? 1 : 0,    
                "skill_jira"           => isset($_POST["jira"]) ? 1 : 0,      
                "skill_github"         => isset($_POST["github"]) ? 1 : 0,    
                "skill_scriptkiddie"   => isset($_POST["scriptkiddie"]) ? 1 : 0, 
                "checkbox_other_skills"=> isset($_POST["checkbox_other_skills"]), 
                "other_skills"         => $_POST["otherskills"] ?? ''      
            );
            
            // contains errors to be presented if there are any
            $eoi_errors = [];

            // server-side validation
            if (trim($eoi_data["job_reference_number"]) === "") {
                $eoi_errors[] = "Please select a Job Reference Number.<br>";
            }

            if (trim($eoi_data["first_name"]) === "") {
                $eoi_errors[] = "Please fill the First Name field.<br>";
            } elseif (strlen($eoi_data["first_name"]) > 20) {
                $eoi_errors[] = "First Name must have no more than 20 characters.<br>";
            } elseif (!preg_match('/^[a-zA-Z]+$/', $eoi_data["first_name"])) {
                $eoi_errors[] = "First Name field must contain only alpha characters.<br>";
            }

            if (trim($eoi_data["last_name"]) === "") {
                $eoi_errors[] = "Please fill the Last Name field.<br>";
            } elseif (strlen($eoi_data["last_name"]) > 20) {
                $eoi_errors[] = "Last Name must have no more than 20 characters.<br>";
            } elseif (!preg_match('/^[a-zA-Z]+$/', $eoi_data["last_name"])) {
                $eoi_errors[] = "Last Name field must contain only alpha characters.<br>";
            }

            if (trim($eoi_data["date_of_birth"]) === "") {
                $eoi_errors[] = "Please fill in Date of Birth field.<br>";
            } elseif (!preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([12]\d{3})$/', $eoi_data["date_of_birth"], $matches)) {
                $eoi_errors[] = "Date of Birth must be in dd/mm/yyyy format.<br>";
            } elseif (!checkdate((int)$matches[2], (int)$matches[1], (int)$matches[3])) { // Use captured groups from successful preg_match
                $eoi_errors[] = "Date of Birth is not a valid calendar date.<br>";
            }

            if (!isset($eoi_data["gender"])) {
                $eoi_errors[] = "Please select a Gender.<br>";
            }

            if (trim($eoi_data["address_street"]) === "") {
                $eoi_errors[] = "Please fill in Street field.<br>";
            } elseif (strlen($eoi_data["address_street"]) > 40) {
                $eoi_errors[] = "Street field must contain a maximum of 40 characters.<br>";
            }

            if (trim($eoi_data["address_suburb"]) === "") {
                $eoi_errors[] = "Please fill in Suburb field.<br>";
            } elseif (strlen($eoi_data["address_suburb"]) > 40) {
                $eoi_errors[] = "Suburb field must contain a maximum of 40 characters.<br>";
            }
            
            if (trim($eoi_data["address_state"]) === "") {
                $eoi_errors[] = "Please select a State.<br>";
            }
            
            if (trim($eoi_data["email_address"]) === "") {
                $eoi_errors[] = "Please fill in Email field.<br>";
            } elseif (!filter_var($eoi_data["email_address"], FILTER_VALIDATE_EMAIL)) {
                $eoi_errors[] = "Email must be valid.<br>";
            }

            if (trim($eoi_data["phone_number"]) === "") {
                $eoi_errors[] = "Please fill in Phone Number field.<br>";
            } elseif (!preg_match('/^[\d ]+$/', $eoi_data["phone_number"])) {
                $eoi_errors[] = "Phone Number must contain only digits and/or spaces.<br>";
            } else {
                $phone_digits = preg_replace('/[^0-9]/', '', $eoi_data['phone_number']);
                if (strlen($phone_digits) < 8 || strlen($phone_digits) > 12) {
                    $eoi_errors[] = "Phone Number must contain 8 to 12 digits excluding spaces.<br>";
                }
            }

            if (isset($eoi_data["checkbox_other_skills"])) {
                if (!isset($eoi_data["other_skills"]) || trim($eoi_data["other_skills"]) === "") { 
                    $eoi_errors[] = "Please fill in Other Skills field. Otherwise uncheck the Other Skills checkbox.<br>";
                }
            }

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
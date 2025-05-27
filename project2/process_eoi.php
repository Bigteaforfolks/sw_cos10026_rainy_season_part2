<?php
    require_once "settings.php";
?>

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

    // Page Header
    include("header.inc");

    // Sends user back if not using POST method
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        // Database connection success or error
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

            mysqli_query($conn, $create_table_sql);

            // setting eoi data as individual variables
            $job_reference_number = $_POST["jobreferencenumber"] ?? '';
            $first_name           = $_POST["firstname"] ?? '';
            $last_name            = $_POST["lastname"] ?? '';
            $date_of_birth        = $_POST["dateofbirth"] ?? '';
            $gender               = $_POST["gender"] ?? null;
            $address_street       = $_POST["streetaddress"] ?? '';
            $address_suburb       = $_POST["suburb"] ?? '';
            $address_state        = $_POST["state"] ?? '';
            $address_postcode     = $_POST['postcode'] ?? '';
            $email_address        = $_POST["emailaddress"] ?? '';
            $phone_number         = $_POST["phonenumber"] ?? '';
            $skill_wireshark      = isset($_POST["wireshark"]) ? 1 : 0;
            $skill_csharp         = isset($_POST["csharp"]) ? 1 : 0;
            $skill_jira           = isset($_POST["jira"]) ? 1 : 0;
            $skill_github         = isset($_POST["github"]) ? 1 : 0;
            $skill_scriptkiddie   = isset($_POST["scriptkiddie"]) ? 1 : 0;
            $other_skills_checkbox = isset($_POST["other_skills_checkbox"]);
            $other_skills         = $_POST["other_skills"] ?? '';

            // contains errors to be presented if there are any
            $eoi_errors = [];

            // server-side validation
            if (trim($job_reference_number) === "") {
                $eoi_errors[] = "Please select a Job Reference Number.";
            }

            if (trim($first_name) === "") {
                $eoi_errors[] = "Please fill the First Name field.";
            } elseif (strlen($first_name) > 20) {
                $eoi_errors[] = "First Name must have no more than 20 characters.";
            } elseif (!preg_match('/^[a-zA-Z]+$/', $first_name)) {
                $eoi_errors[] = "First Name field must contain only alpha characters.";
            }

            if (trim($last_name) === "") {
                $eoi_errors[] = "Please fill the Last Name field.";
            } elseif (strlen($last_name) > 20) {
                $eoi_errors[] = "Last Name must have no more than 20 characters.";
            } elseif (!preg_match('/^[a-zA-Z]+$/', $last_name)) {
                $eoi_errors[] = "Last Name field must contain only alpha characters.";
            }

            if (trim($date_of_birth) === "") {
                $eoi_errors[] = "Please fill in Date of Birth field.";
            } elseif (!preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([12]\d{3})$/', $date_of_birth, $matches)) {
                $eoi_errors[] = "Date of Birth must be in dd/mm/yyyy format.";
            } elseif (!checkdate((int)$matches[2], (int)$matches[1], (int)$matches[3])) { // Use captured groups from successful preg_match
                $eoi_errors[] = "Date of Birth is not a valid calendar date.";
            }

            if (!isset($gender)) {
                $eoi_errors[] = "Please select a Gender.";
            }

            if (trim($address_street) === "") {
                $eoi_errors[] = "Please fill in Street field.";
            } elseif (strlen($address_street) > 40) {
                $eoi_errors[] = "Street field must contain a maximum of 40 characters.";
            }

            if (trim($address_suburb) === "") {
                $eoi_errors[] = "Please fill in Suburb field.";
            } elseif (strlen($address_suburb) > 40) {
                $eoi_errors[] = "Suburb field must contain a maximum of 40 characters.";
            }
            
            if (trim($address_state) === "") {
                $eoi_errors[] = "Please select a State.";
            }

            // AI assisted content
            //Prompt: "Without using JavaScript, how would I validate postcodes for each Australian state?"
            if (trim($address_postcode) === "") {
                $eoi_errors[] = "Please enter a postcode.";
            } else {
                switch ($address_state) {
                    case 'VIC':
                        if ($address_postcode < '3000' || $address_postcode > '3999') {
                            $eoi_errors[] = "Postcode must be between 3000 and 3999 for Victoria.";
                        }
                        break;
                    case 'NSW':
                        if ($address_postcode < '1000' || $address_postcode > '1999') {
                            $eoi_errors[] = "Postcode must be between 1000 and 1999 for New South Wales.";
                        }
                        break;
                    case 'QLD':
                        if ($address_postcode < '4000' || $address_postcode > '4999') {
                            $eoi_errors[] = "Postcode must be between 4000 and 4999 for Queensland.";
                        }
                        break;
                    case 'NT':
                        if ($address_postcode < '0800' || $address_postcode > '0899') {
                            $eoi_errors[] = "Postcode must be between 0800 and 0899 for Northern Territory.";
                        }
                        break;
                    case 'WA':
                        if ($address_postcode < '6000' || $address_postcode > '6999') {
                            $eoi_errors[] = "Postcode must be between 6000 and 6999 for Western Australia.";
                        }
                        break;
                    case 'SA':
                        if ($address_postcode < '5000' || $address_postcode > '5799') {
                            $eoi_errors[] = "Postcode must be between 5000 and 5799 for South Australia.";
                        }
                        break;
                    case 'TAS':
                        if ($address_postcode < '7000' || $address_postcode > '7999') {
                            $eoi_errors[] = "Postcode must be between 7000 and 7999 for Tasmania.";
                        }
                        break;
                    case 'ACT':
                        if ($address_postcode < '0200' || $address_postcode > '0299') {
                            $eoi_errors[] = "Postcode must be between 0200 and 0299 for Australian Capital Territory.";
                        }
                        break;
                default:
                    $eoi_errors[] = "Invalid state selected for postcode validation.";
            }}
            // end of AI assisted content

            if (trim($email_address) === "") {
                $eoi_errors[] = "Please fill in Email field.";
            } elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                $eoi_errors[] = "Email must be valid.";
            }

            if (trim($phone_number) === "") {
                $eoi_errors[] = "Please fill in Phone Number field.";
            } elseif (!preg_match('/^[\d ]+$/', $phone_number)) {
                $eoi_errors[] = "Phone Number must contain only digits and/or spaces.";
            } else {
                $phone_digits = preg_replace('/[^0-9]/', '', $phone_number);
                if (strlen($phone_digits) < 8 || strlen($phone_digits) > 12) {
                    $eoi_errors[] = "Phone Number must contain 8 to 12 digits excluding spaces.";
                }
            }

            // Other Skills validation
            $other_skills_filled = trim($other_skills) !== '';

            if ($other_skills_checkbox && !$other_skills_filled) {
                $eoi_errors[] = "Please fill in the Other Skills field if you checked the box.";
            } elseif (!$other_skills_checkbox && $other_skills_filled) {
                $eoi_errors[] = "Please check the Other Skills box if you want to provide other skills.";
            }

            if (empty($eoi_errors)) {
                // insert values into table as a new record
                $query = "INSERT INTO eoi (job_reference_number, first_name, last_name, date_of_birth, gender, address_street, address_suburb, address_state, address_postcode, email_address, phone_number, skill_wireshark, skill_csharp, skill_jira, skill_github, skill_scriptkiddie, other_skills) 
                VALUES ('$job_reference_number', '$first_name', '$last_name', '$date_of_birth', '$gender', '$address_street', '$address_suburb', '$address_state', '$address_postcode', '$email_address', '$phone_number', $skill_wireshark, $skill_csharp, $skill_jira, $skill_github, $skill_scriptkiddie, '$other_skills')";

                // successful application, shows eoi number
                if (mysqli_query($conn, $query)) {
                    $eoi_number = mysqli_insert_id($conn);
                    echo "<div class='msg'>";
                        echo "<h2>Application Submitted Successfully!</h2>";
                        echo "<p>Your EOI number is: <strong>" . $eoi_number . "</strong></p>";
                    echo "</div>";
                } else {
                    include "description_error.inc";
                    echo "<div class='msg'>";
                        echo "<p>Error: " . mysqli_error($conn) . "</p>";
                    echo "</div>";
                }

            } else {

                include "description_error.inc";
                echo "<div class='msg'>";
                    echo "<h3>Application Submission Failed</h3>";
                    echo "<p>Please correct the following errors:</p>";
                    echo "<ul>";
                    foreach ($eoi_errors as $field => $error_message) {
                        echo "<li>" . htmlspecialchars($error_message) . "</li>";
                    }
                    echo "</ul>";
                    echo "<p><a href='apply.php'>Go back to Application Form</a></p>";
                echo "</div>";
            }
        } else {
            // display connection error
            include "description_error.inc";
            echo "<div class='msg'>";
                echo "<h3>Database Connection Error</h3>";
                echo "<p>Unable to connect to database. Error: " . mysqli_connect_error() . "</p>";
            echo "</div>";
        }
    } else {
        // if no post method detected, deny user access
        include "description_error.inc";
        echo "<div class='msg'>";
            echo "<h3>Access Denied</h3>";
            echo "<p>You should not be here, go back to the <a href='apply.php'>Application Form</a>, man.</p>";
        echo "</div>";
    }
    
    // include footer
    include_once("footer.inc");
    mysqli_close($conn);
?>
</body>
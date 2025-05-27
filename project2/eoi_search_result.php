<?php
    // Initialising and setting connection and global variables
    include_once "settings.php";
    $action = mysqli_real_escape_string($conn, $_GET['submit']);
    $query = "SELECT * FROM eoi";

    // Function to list all records
    function list_result($result) {

        // Heading and Description
        echo "<section class='description'>";
        echo "<h2>Rainy Season Expressions of Interest</h2>";
        echo "<p>Displayed below are the Expressions of Interest for job positions offered by Rainy Season&period;</p>";
        echo "</section>";

        echo "<table id='eoi_table' border = '1' cellpadding='2.5'>";
        echo "<tr>
                <th>EOI Number</th>
                <th>Job Reference Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Street</th>
                <th>Suburb</th> 
                <th>State</th>
                <th>Postcode</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Wireshark?</th>
                <th>C#?</th>
                <th>Jira?</th>
                <th>Github?</th>
                <th>Scriptkiddie?</th>
                <th>Other Skills</th>
                <th>Status</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['eoi_number'] . "</td>";
            echo "<td>" . $row['job_reference_number'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['address_street'] . "</td>";
            echo "<td>" . $row['address_suburb'] . "</td>";
            echo "<td>" . $row['address_state'] . "</td>";
            echo "<td>" . $row['address_postcode'] . "</td>";
            echo "<td>" . $row['email_address'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td>" . ($row['skill_wireshark'] == 1 ? "True" : "False") . "</td>";
            echo "<td>" . ($row['skill_csharp'] == 1 ? "True" : "False") . "</td>";
            echo "<td>" . ($row['skill_jira'] == 1 ? "True" : "False") . "</td>";
            echo "<td>" . ($row['skill_github'] == 1 ? "True" : "False") . "</td>";
            echo "<td>" . ($row['skill_scriptkiddie'] == 1 ? "True" : "False") . "</td>";
            echo "<td>" . $row['other_skills'] . "</td>";
            echo "<td>" . $row['eoi_status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Results of EOI Table Search from Database.">
    <meta name="keywords" content="Rainy Season, Jobs, Apply, Application, Work">
    <meta name="author" content="Jacob Ang">
    <title>Rainy Season EOI Search Result</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body id="eoi-search-result-page">

<?php

    // Page Header
    include "header.inc";

    // Display EOIs when List EOIs button selected
    if ($action == "List EOIs") {

        // Set filter variables
        $filter_job = mysqli_real_escape_string($conn, $_GET['filter-job']);
        $filter_first_name = mysqli_real_escape_string($conn, $_GET['filter-first-name']);
        $filter_last_name = mysqli_real_escape_string($conn, $_GET['filter-last-name']);

        // Set Filter SQL Query
        if (trim($filter_job) !== "") {
            if (trim($filter_first_name) !== "" && trim($filter_last_name) !== "") { 

                // When Job, First Name, and Last Name filters are set
                $query = "SELECT * FROM eoi
                                WHERE job_reference_number LIKE '%$filter_job%'
                                AND first_name LIKE '%$filter_first_name%'
                                AND last_name LIKE '%$filter_last_name%'";
            
            } elseif (trim($filter_first_name) !== "" && trim($filter_last_name) === "") { 

                // When Job, and First Name filters are set
                $query = "SELECT * FROM eoi
                                WHERE job_reference_number LIKE '%$filter_job%'
                                AND first_name LIKE '%$filter_first_name%'";

            } elseif (trim($filter_first_name) === "" && trim($filter_last_name) !== "") { 
                
                // When Jobs, and Last Name filters are set
                $query = "SELECT * FROM eoi
                                WHERE job_reference_number LIKE '%$filter_job%'
                                AND last_name LIKE '%$filter_last_name%'";

            } elseif (trim($filter_first_name) === "" && trim($filter_last_name) === "") { 
                
                // When Jobs filter is set
                $query = "SELECT * FROM eoi
                                WHERE job_reference_number LIKE '%$filter_job%'";

            }
        } elseif (trim($filter_job) === "") {
            if (trim($filter_first_name) !== "" && trim($filter_last_name) !== "") { 
                
                // When First Name and Last Name filters are set
                $query = "SELECT * FROM eoi
                                WHERE first_name LIKE '%$filter_first_name%'
                                AND last_name LIKE '%$filter_last_name%'";

            } elseif (trim($filter_first_name) !== "" && trim($filter_last_name) === "") { 
                
                // When First Name filter is set
                $query = "SELECT * FROM eoi
                                WHERE first_name LIKE '%$filter_first_name%'";

            } elseif (trim($filter_first_name) === "" && trim($filter_last_name) !== "") { 
                
                // When Last Name filter is set
                $query = "SELECT * FROM eoi
                                WHERE last_name LIKE '%$filter_last_name%'";

            }
        }

        // Set new query if one and display records in a table
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            // Calls to a function that loads value of $result
            list_result($result);

        } else {
            include "description_error.inc";
            echo "<div class='msg'>";
                echo "<p>EOI does not exist.</p>";
                echo "<p>Please confirm existing EOIs by listing all in the <a href='manage.php'>Manage Page.</a></p>";
            echo "</div>";
        }

    // Displays all EOIs after deleting records of a chosen job reference number
    } elseif ($action == "Delete EOIs") {

        // Set filter variables
        $filter_job = mysqli_real_escape_string($conn, $_GET['filter-job']);
        $query = "DELETE FROM eoi WHERE job_reference_number LIKE '%$filter_job%'";

        // Are you sure?

        // Set new query if one and display records in a table
        // $before = mysqli_query($conn, "SELECT * FROM eoi");
        $result = mysqli_query($conn, $query);

        if ($result) {
            $result = mysqli_query($conn, "SELECT * FROM eoi");
            list_result($result);
        } else {
            include "description_error.inc";
            echo "<div class='msg'>";
                echo "<p>Error deleting EOI: " . mysqli_error($conn) . "</p>";
                echo "<p>Please confirm there are eligible EOIs to be deleted by listing all in the <a href='manage.php'>Manage Page.</a></p>";
            echo "</div>";
        }

    // Displays all EOIs after changing the status of a chosen record
    } elseif ($action == "Change EOI Status") {

        // Set form values
        $filter_eoi_number = mysqli_real_escape_string($conn, $_GET['filter-eoi-number']);
        $status = mysqli_real_escape_string($conn, $_GET['status']);

        $query = "SELECT * FROM eoi WHERE eoi_number='$filter_eoi_number'";

        $result = mysqli_query($conn, $query);

        // Check ID Validity
        if (mysqli_num_rows($result) > 0) {
            
            // Set modify query
            $query = "UPDATE eoi SET eoi_status = '$status  ' 
                                 WHERE eoi_number = '$filter_eoi_number'";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $result = mysqli_query($conn, "SELECT * FROM eoi");
                list_result($result);
            } else {
                include "description_error.inc";
                echo "<div class='msg'>";
                    echo "<p>Error modifying EOI: " . mysqli_error($conn) . "</p>";
                    echo "<p>Please confirm the existing EOIs by listing all in the <a href='manage.php'>Manage Page.</a></p>";
                echo "</div>";
            }

        } else {
            include "description_error.inc";
            echo "<div class='msg'>";
                echo "<p>Selected EOI Number (ID: " . $filter_eoi_number . ") does not exist.</p>";
                echo "<p>Please confirm the existing EOIs by listing all in the <a href='manage.php'>Manage Page.</a></p>";
            echo "</div>";
        }
    }

    // Page Footer and SQL close
    include "footer.inc";
    mysqli_close($conn);
?>

</body>
</html>
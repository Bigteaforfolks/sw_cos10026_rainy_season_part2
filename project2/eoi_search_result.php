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
        include "header.inc";

        // Connecting to database and initial query
        include_once "settings.php";
        $sql_query = "SELECT * FROM eoi";

        // Set value of filters
        $filter_job = mysqli_real_escape_string($conn, $_GET['filter-job']);
        $filter_first_name = mysqli_real_escape_string($conn, $_GET['filter-first-name']);
        $filter_last_name = mysqli_real_escape_string($conn, $_GET['filter-last-name']);

        // Set job filter SQL
        if (trim($filter_job) !== "") { // If $filter_job is set
            if (trim($filter_first_name) !== "" && trim($filter_last_name) !== "") { // If $filter_job, $filter_first_name, and $filter_last_name is set
                $sql_query = "SELECT * FROM eoi
                              WHERE job_reference_number LIKE '%$filter_job%'
                                AND first_name LIKE '%$filter_first_name%'
                                AND last_name LIKE '%$filter_last_name%'";
            } elseif (trim($filter_first_name) !== "" && trim($filter_last_name) === "") { // If $filter_job, and $filter_first_name is set
                $sql_query = "SELECT * FROM eoi
                              WHERE job_reference_number LIKE '%$filter_job%'
                                AND first_name LIKE '%$filter_first_name%'";
            } elseif (trim($filter_first_name) === "" && trim($filter_last_name) !== "") { // If $filter_job, and $filter_last_name is set
                $sql_query = "SELECT * FROM eoi
                              WHERE job_reference_number LIKE '%$filter_job%'
                                AND last_name LIKE '%$filter_last_name%'";
            }
        } elseif (trim($filter_job) === "") { // If $filter_job is not set
            if (trim($filter_first_name) !== "" && trim($filter_last_name) !== "") { // If $filter_first_name, and $filter_last_name is set
                $sql_query = "SELECT * FROM eoi
                              WHERE first_name LIKE '%$filter_first_name%'
                                AND last_name LIKE '%$filter_last_name%'";
            } elseif (trim($filter_first_name) !== "" && trim($filter_last_name) === "") { // If $filter_first_name is set
                $sql_query = "SELECT * FROM eoi
                              WHERE first_name LIKE '%$filter_first_name%'";
            } elseif (trim($filter_first_name) === "" && trim($filter_last_name) !== "") { // If $filter_last_name is set
                $sql_query = "SELECT * FROM eoi
                               WHERE last_name LIKE '%$filter_last_name%'";
            }
        }

        // Display records in a table
        $result = mysqli_query($conn, $sql_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
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
                echo "<td>" . $row['skill_wireshark'] . "</td>";
                echo "<td>" . $row['skill_csharp'] . "</td>";
                echo "<td>" . $row['skill_jira'] . "</td>";
                echo "<td>" . $row['skill_github'] . "</td>";
                echo "<td>" . $row['skill_scriptkiddie'] . "</td>";
                echo "<td>" . $row['other_skills'] . "</td>";
                echo "<td>" . $row['eoi_status'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No matching EOIs found.";
        }

        mysqli_close($conn);
        include "footer.inc";
    ?>

</body>
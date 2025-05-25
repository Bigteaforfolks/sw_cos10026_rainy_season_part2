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

        mysqli_close($conn);
        include "footer.inc";
    ?>

</body>
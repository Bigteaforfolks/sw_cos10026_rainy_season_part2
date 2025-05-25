<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Manage Page for EOI Table of Database.">
    <meta name="keywords" content="Rainy Season, Jobs, Apply, Application, Work">
    <meta name="author" content="Jacob Ang">
    <title>Rainy Season Manage Page</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body id="manage-page">

<?php
    include 'header.inc';
?>

<!-- Information about the page -->
<section class="description">

    <h2>Rainy Season Manage Page</h2>
    <p>You should only be here if you are the HR Manager of Rainy Season or have higher authority&period;</p>

</section>

<!-- List EOIs -->
<div class="sql-action">
    <form method="GET" action="eoi_search_result.php">

        <!-- Filter by Job Reference Number -->
        <label for="filter-job">Filter by Job Reference Number:</label>
        <select name="filter-job" id="filter-job">
            <option value="" selected>Job Reference Number</option>
            <option value="RX7FD">RX7FD &#8209; Cybersecurity Specialist</option>
            <option value="SIGC8">SIGC8 &#8209; Software Developer</option>
        </select>  

        <!-- Filter by First Name, Last Name, or Both -->
        <label for="filter-name">Filter by Name:</label>
        <input type="text" name="filter-first-name" placeholder="First Name">
        <input type="text" name="filter-last-name" placeholder="Last Name">

        <!-- Submit Entered Values -->    
        <input type="submit" value="List EOIs">

    </form>
<div>

<!-- Delete EOIs -->
<div class="sql-action">
    <form method="GET" action="eoi_search_result.php">

        <!-- Filter by Job Reference Number -->
        <label for="filter-job">Filter by Job Reference Number:</label>
        <select name="filter-job" id="filter-job">
            <option value="" selected>Job Reference Number</option>
            <option value="RX7FD">RX7FD &#8209; Cybersecurity Specialist</option>
            <option value="SIGC8">SIGC8 &#8209; Software Developer</option>
        </select>

        <!-- Submit Entered Values -->    
        <input type="submit" value="Delete EOIs">

    </form>
</div>


<!-- Change EOI Status -->


<?php
    include 'footer.inc';
?>

</body>
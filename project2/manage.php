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
        <input type="submit" name="submit" value="List EOIs">

    </form>
<div>

<!-- Delete EOIs -->
<div class="sql-action">
    <form method="GET" action="eoi_search_result.php">

        <!-- Filter by Job Reference Number -->
        <label for="filter-job">Filter by Job Reference Number:</label>
        <select name="filter-job" id="filter-job">
            <option value="" selected disabled>Job Reference Number</option>
            <option value="RX7FD">RX7FD &#8209; Cybersecurity Specialist</option>
            <option value="SIGC8">SIGC8 &#8209; Software Developer</option>
        </select>

        <!-- Submit Entered Values -->    
        <input type="submit" name="submit" value="Delete EOIs">

    </form>
</div>


<!-- Change EOI Status -->
<div class="sql-action">
    <form method="GET" action="eoi_search_result.php">

        <!-- Filter by EOI Number -->
        <label for="filter-eoi-number">Enter the ID of the EOI whose status you would like to change:</label>
        <input type="number" name="filter-eoi-number">

        <!-- Select what status to change to --> 
        <label for="status">Change status to:</label>
        <select name="status" id="status">
            <option value="" selected disabled>Status</option>
            <option value="New">New</option>
            <option value="Current">Current</option>
            <option value="Final">Final</option>
        </select>

        <!-- Submit Entered Values -->    
        <input type="submit" name="submit" value="Change EOI Status">

    </form>
</div>

<?php
    include 'footer.inc';
?>

</body>
</html>
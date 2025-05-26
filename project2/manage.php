<?php
session_start();
require_once("settings.php");

// check if user is logged in
if (!isset($_SESSION['username'])) {
    // redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>

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

    <h2>Rainy Season Management Page</h2>

</section>

<div id="form-container">

    <!-- List EOIs -->
    <div class="form-section"> <!-- Changed .sql-action to .form-section -->
        <form method="GET" action="eoi_search_result.php">
            <div class="form-group">
                <div class="form-field">

                    <!-- Filter by Job Reference Number -->
                    <label for="filter-job-list" class="form-field__label">Filter by Job Reference Number:</label> <!-- Updated for and class -->
                    <select name="filter-job" id="filter-job-list" class="form-field__select"> <!-- Added class, unique ID -->
                        <option value="" selected>Job Reference Number</option>
                        
                        <!-- AI assisted content
                        Prompt: Change this code to a foreach loop to allow it to run twice, and skip duplicate options -->
                        <?php
                        require_once("settings.php");

                        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                        if ($conn) {
                            $query = "SELECT job_reference_number FROM eoi";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                $seen_refs = [];

                                foreach ($rows as $row) {
                                    $ref = $row['job_reference_number'];
                                    if (!in_array($ref, $seen_refs)) {
                                        $seen_refs[] = $ref;
                                        $safe_ref = htmlspecialchars($ref);
                                        echo "<option value='{$safe_ref}'>{$safe_ref}</option>";
                                    }
                                }
                            }

                            mysqli_close($conn);
                        } else {
                            echo "<option disabled>No applications for any positions.</option>";
                        }
                        ?>
                        <!-- End of AI assisted content -->

                    </select>  
                </div>
                
                <!-- Filter by First Name, Last Name, or Both -->
                <div class="form-field">
                    <label for="filter-first-name-list" class="form-field__label">First Name:</label>
                    <input type="text" name="filter-first-name" id="filter-first-name-list" class="form-field__textbox" placeholder="First Name">
                </div>
                <div class="form-field">
                    <label for="filter-last-name-list" class="form-field__label">Last Name:</label>
                    <input type="text" name="filter-last-name" id="filter-last-name-list" class="form-field__textbox" placeholder="Last Name">
                </div>

            </div>

            <!-- Submit Entered Values -->
            <div class="form-input">
                <input type="submit" name="submit" class="form-button" value="List EOIs">
            </div>
        </form>
    </div> <!-- Corrected closing div -->

    <!-- Delete EOIs -->
    <div class="form-section">
        <form method="GET" action="eoi_search_result.php">
            <div class="form-group">

                <!-- Filter by Job Reference Number -->
                <div class="form-field">
                    <label for="filter-job-delete" class="form-field__label">Filter by Job Reference Number:</label>
                    <select name="filter-job" id="filter-job-delete" class="form-field__select">
                        <option value="" selected disabled>Job Reference Number</option>
                        <?php
                        require_once("settings.php");

                        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                        if ($conn) {
                            $query = "SELECT job_reference_number FROM eoi";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                $seen_refs = [];

                                foreach ($rows as $row) {
                                    $ref = $row['job_reference_number'];
                                    if (!in_array($ref, $seen_refs)) {
                                        $seen_refs[] = $ref;
                                        $safe_ref = htmlspecialchars($ref);
                                        echo "<option value='{$safe_ref}'>{$safe_ref}</option>";
                                    }
                                }
                            }
                            mysqli_close($conn);
                        } else {
                            echo "<option disabled>No applications for any positions.</option>";
                        }
                        ?>
                        <!-- End of AI assisted content -->
                    </select>
                </div>
            </div>

            <!-- Submit Entered Values -->   
            <div class="form-input">
                <input type="submit" name="submit" class="form-button" value="Delete EOIs">
            </div>
        </form>
    </div>


    <!-- Change EOI Status -->
    <div class="form-section">
        <form method="GET" action="eoi_search_result.php">
            <div class="form-group">
                <div class="form-field">

                    <!-- Filter by EOI Number -->
                    <label for="filter-eoi-number" class="form-field__label">Enter EOI ID to change status:</label> <!-- Updated class, slightly rephrased for clarity with 20% width -->
                    
                    <!-- AI assisted content
                    Prompt: How can I dynamically change the range of this input? -->
                    <?php
                    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
                    $max_eoi_id = 0;
                    if ($conn) {
                        $query_max = "SELECT MAX(eoi_number) AS max_id FROM eoi";
                        $result_max = mysqli_query($conn, $query_max);
                        if ($result_max && $row_max = mysqli_fetch_assoc($result_max)) {
                            $max_eoi_id = $row_max['max_id'] ?? 0;
                        }
                        mysqli_close($conn);
                    }
                    ?>
                    <input type="number" name="filter-eoi-number" id="filter-eoi-number" class="form-field__textbox" min="1" max="<?php echo $max_eoi_id; ?>">
                </div>

                <div class="form-field">
                    <label for="status" class="form-field__label">Change status to:</label>
                    <select name="status" id="status" class="form-field__select">
                        <option value="" selected disabled>Status</option>
                        <option value="New">New</option>
                        <option value="Current">Current</option>
                        <option value="Final">Final</option>
                    </select>
                </div>
            </div>

            <!-- Submit Entered Values --> 
            <div class="form-input">
                <input type="submit" name="submit" class="form-button" value="Change EOI Status">
            </div>
        </form>
    </div>

    <div class="form-section">
        <div class="form-group">
             <div class="form-input">
                <form method="get" action="register.php">
                    <button type="submit" class="form-button">Register new admin</button>
                </form>
                <form method="post" action="logout.php">
                    <button type="submit" class="form-button">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include 'footer.inc';
?>

</body>
</html>
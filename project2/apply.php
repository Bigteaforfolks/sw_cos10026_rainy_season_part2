<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Job Application page of the Rainy Season website.">
    <meta name="keywords" content="Rainy Season, Jobs, Apply, Application, Work, Form">
    <meta name="author" content="Jacob Ang">
    <title>Rainy Season Job Application Page</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body id="apply-page">
    <?php
        include 'header.inc';
    ?>

    <!-- Information about the page -->
    <section class="description">

        <h2>Rainy Season Job Application Form</h2>
        <p>In order to express your interest&comma; please fill out the form below. All information is sent directly to management and is not passed through any third party.</p>

    </section>
    
    <!-- Information will be sent through POST method and echoed back with the values inputted -->
    <form id="form-container" action="process_eoi.php" method="post" novalidate="novalidate">

        <div class="form-section form-section--personalinformation">

            <!-- Information about why personal info is collected -->
            <section class="form-section-introduction">
                <h3>Personal Information</h3>
                <p>Please tell us about yourself&#33; This helps us get to know you&comma; as well as allowing us to get in contact with you if your application has been accepted&#33;</p>
            </section>

            <div class="form-group form-group--name">

                <!-- First Name (Textbox) -->
                <div class="form-field">
                    <label for="firstname" class="form-field__label">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-field__textbox" pattern="^[a-zA-Z]{1,20}$" placeholder="e.g. John" required>
                </div>

                <!-- Last Name (Textbox) -->
                <div class="form-field">
                    <label for="lastname" class="form-field__label">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-field__textbox" pattern="^[a-zA-Z]{1,20}$" placeholder="e.g. Smith" required>
                </div>

            </div>

            <div class="form-group form-group--contact">

                <!-- Email Address (Textbox) -->
                <div class="form-field">
                    <label for="emailaddress" class="form-field__label">Email Address</label>
                    <input type="text" name="emailaddress" id="emailaddress" class="form-field__textbox" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" placeholder="e.g. user@domain.com.au" required> <!-- RegEx sourced from https://regexr.com/3e48o -->
                </div>
                
                <!-- Phone Number (Textbox) -->
                <div class="form-field">
                    <label for="phonenumber" class="form-field__label">Phone Number</label>
                    <input type="text" name="phonenumber" id="phonenumber" class="form-field__textbox" pattern="^[\d ]{8,12}$" placeholder="e.g. 0412345678" required>
                </div>
            </div>

            <div class="form-group form-group--other">

                <!-- Date of Birth (Textbox) -->
                <div class="form-field">
                    <label for="dateofbirth" class="form-field__label">Date of Birth</label>
                    <input type="text" name="dateofbirth" id="dateofbirth" class="form-field__textbox" pattern="^(0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/\d{4}$" placeholder="DD/MM/YYYY" required>
                </div>
                
                <!-- Gender (Radio Buttons)-->
                <div class="form-field form-field--radio">
                    <fieldset>
                        <legend>Gender</legend> 
                        <div class="form-field">
                            <input type="radio" name="gender" id="male" class="form-field__radio" value="male" required>
                            <label for="male" class="form-field__label">Male</label>
                        </div>

                        <div class="form-field">
                            <input type="radio" name="gender" id="female" class="form-field__radio" value="female">
                            <label for="female" class="form-field__label">Female</label>
                        </div>

                        <div class="form-field">
                            <input type="radio" name="gender" id="other" class="form-field__radio" value="other">      
                            <label for="other" class="form-field__label">Other</label>  
                        </div>
                    </fieldset>
                </div>

            </div>

        </div>

        <div class="form-section form-section--address">

            <!-- Information about why address is collected -->
            <section class="form-section-introduction">
                <h3>Address</h3>
                <p>Tell us where you live&period;</p>
            </section>
    
            <div class="form-group form-group--address">
    
                <!-- Street Address (Textbox) -->
                <div class="form-field">
                    <label for="streetaddress" class="form-field__label">Street Address</label>
                    <input type="text" name="streetaddress" id="streetaddress" class="form-field__textbox" pattern="^{1,40}$" placeholder="e.g. 427-451 Burwood Rd" required>
                </div>
    
                <!-- Suburb (Textbox) -->
                <div class="form-field">
                    <label for="suburb" class="form-field__label">Suburb</label>
                    <input type="text" name="suburb" id="suburb" class="form-field__textbox" pattern="^{1,40}$" placeholder="e.g. Hawthorn" required>
                </div>
    
                <!-- State (Select Box) -->
                <div class="form-field">
                    <label for="state" class="form-field__label">State</label>
                    <select name="state" id="state" class="form-field__select" required>
                        <option value="">Please Select a State</option>
                        <option value="ACT">ACT</option>
                        <option value="NSW">NSW</option>
                        <option value="NT">NT</option>
                        <option value="QLD">QLD</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="VIC">VIC</option>
                        <option value="WA">WA</option>
                    </select>
                </div>
    
                <!-- Postcode (Textbox) -->
                <div class="form-field">
                    <label for="postcode" class="form-field__label">Postcode</label>

                    <!-- ChatGPT was used to assist in figuring out how to restrict postcode input to specific values using pattern -->
                    <!-- Prompt: "How would I set a range restriction from 0200 to 9944 using pattern for an input that accepts 4 digits?" -->
                    <input type="text" name="postcode" id="postcode" class="form-field__textbox" pattern="^(0[2-9][0-9]{2}|[1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-3][0-9]|994[0-4])$" maxlength="4" placeholder="e.g. 3122" required>
                </div>
    
            </div>
        </div>

        <div class="form-section form-section--jobrelated">

            <!-- Information about why job-related information is collected -->
            <section class="form-section-introduction">
                <h3>Position Information</h3>
                <p>Select your desired position and express your skills which you have acrewed throughout your years in the industry&excl;</p>
            </section>

            <div class="form-group form-group--jobreferencenumber">

                <!-- Job Reference Number (Select Box) -->
                <div class="form-field">
                    <label for="jobreferencenumber" class="form-field__label">Position</label>
                    <select name="jobreferencenumber" id="jobreferencenumber" class="form-field__select" required>
                        <!-- "" is selected by default but cannot be used as a valid selection -->
                        <option value="" disabled selected>Please select a position</option>
                        
                            <?php
                            require_once("settings.php");

                            $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                            if ($conn) {
                                $query = "SELECT job_reference_number, position FROM jobs";
                                $result = mysqli_query($conn, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $ref = htmlspecialchars($row['job_reference_number']);
                                        $pos = htmlspecialchars($row['position']);
                                        echo "<option value='{$ref}'>{$ref} &#8209; {$pos}</option>";
                                    }
                                }
                                mysqli_close($conn);
                            } else {
                                echo "<option disabled>There are no positions open at this time.</option>";
                            }
                            ?>
                    </select>
                </div>

            </div>

            <div class="form-group form-group--technicalskills">

                <!-- Technical List (Checkboxes) -->
                <div>
                    <p>Technical Skills</p>
                    <div class="form-field">
                        <input type="checkbox" name="wireshark" id="wireshark" class="form-field__checkbox" required>
                        <label for="wireshark" class="form-field__label"><strong>30&#43;</strong> years of experience with <em>Wireshark</em></label>
                    </div>
                    
                    <div class="form-field">
                        <input type="checkbox" name="csharp" id="csharp" class="form-field__checkbox">
                        <label for="csharp" class="form-field__label"><strong>25&#43;</strong> years of experience with <em>C&#35;</em></label>
                    </div>
                    
                    <div class="form-field">
                        <input type="checkbox" name="jira" id="jira" class="form-field__checkbox">
                        <label for="jira" class="form-field__label"><strong>23&#43;</strong> years of experience with <em>Jira</em></label>
                    </div>
                    
                    <div class="form-field">
                        <input type="checkbox" name="github" id="github" class="form-field__checkbox">
                        <label for="github" class="form-field__label">Average <strong>5000&#43;</strong> <em>GitHub commits</em> per annum</label>
                    </div>
                    
                    <div class="form-field">
                        <input type="checkbox" name="scriptkiddie" id="scriptkiddie" class="form-field__checkbox">
                        <label for="scriptkiddie" class="form-field__label"><em>University of Script Kiddies</em> <strong>&apos;Certificate of Mass Nuisance&apos;</strong></label>
                    </div>
                </div>
                
            </div>

            <div class="form-group form-group--otherskills">

                <!-- Other Skills (Textbox) -->
                <div class="form-field">
                    <input type="checkbox" name="other_skills_checkbox" id="other_skills_checkbox" class="form-field__checkbox">
                    <label for="other_skills" class="form-field__label" id="form-field">Other Skills</label>
                    <textarea name="other_skills" id="other_skills" class="form-field__textarea" rows="3"></textarea>
                </div>

            </div>

        </div>

        <div class="form-input">
            <button id="submit-button" form="form-container">Apply</button>
        </div>

    </form>

    <?php
        include 'footer.inc';
    ?>
</body>

</html>
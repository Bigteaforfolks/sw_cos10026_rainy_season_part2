<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="About page of Rainy Season website">
    <meta name="keywords" content="Rainy Season, About, Information, Team, Group, Info">
    <meta name="author" content="Oakley Tang">
    <title>About &sol; Rainy Season</title>

    <!-- Reference to external CSS file -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body id="about-page">
    <?php
        include 'header.inc';
    ?>
        
    <section class="description">
        <h2>About Us</h2>
    </section>
    
    <!-- team basic information section -->
    <section id="team-basic-info">    
        <h3>Team Basic Information</h3>
        <ul id="student-ids">
            <li>Student IDs
                <ul>
                    <li>105914449 (Jacob)</li>
                    <li>105928408 (Oakley)</li>
                </ul>
            </li>
        </ul>
        <ul>
            <li>Group name: Rainy Season</li>
            <li>Class time: Friday, 2:30 pm
                <ul>
                    <li>Tutor: Razeen Hashmi</li>
                </ul>
            </li>
        </ul>
    </section>

    <hr class="separator">

    <div class="team-photo-section">
        <img id="team-photo"
        src="images/team_photo.png"
        alt="Rainy Season Team">
    </div>

    <!-- Member contribition section -->
    <section id="member-contribution">
        <h3>Contribution by group members</h3>
        
        <!-- Definition list to tie member and contribution together -->
        <dl>
            <div class="jacob-contribution">
                <dt>Jacob</dt>
                <dd>
                    <ul>
                        <li>Main page</li>
                        <li>Apply page</li>
                        <li>CSS style file</li>
                        <li>Code comment checking</li>
                        <li>Jira project management</li>
                    </ul>
                </dd>
            </div>

            <div class="oakley-contribution">
                <dt>Oakley</dt>
                <dd>
                    <ul>
                        <li>Jobs page</li>
                        <li>About page</li>
                        <li>CSS style file</li>
                        <li>Accessibility checking</li>
                        <li>Jira project management</li>
                        <li>Site modularisation using php and .inc files</li>
                    </ul>
                </dd>   
            </div>     
        </dl>
    </section>

    <hr class="separator"> 
    
    <!-- Member interests section -->
    <div class="interests">
        <table>
            <caption>Interests of Rainy Season team members</caption>
            <thead>
                <tr>
                    <td></td>
                    <th scope="col">Jacob</th>
                    <th scope="col">Oakley</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Interest 1</th>
                    
                    <!-- Merged cell for shared interest -->
                    <td colspan="2">Japanese rock music</td>
                </tr>
                <tr>
                    <th scope="row">Interest 2</th>
                    
                    <!-- Merged cell for shared interest -->
                    <td colspan="2">Cars and motorsport</td>
                </tr>
                <tr>
                    <th scope="row">Interest 3</th>
                    <td>Counter-Strike</td>
                    <td>Need for Speed</td>
                </tr>
            </tbody>
        </table>        
    </div>

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
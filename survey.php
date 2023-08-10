<?php
session_start();
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey</title>
    <link rel="stylesheet" href="Css_files/survey.css">
</head>
<body>
    <div class="survey">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
        <p>Select an option:</p>
        <ul>
            <li><a href="create_survey.php">Create a New Survey</a></li>
            <li><a href="view_response.php">View Report</a></li>
        </ul>
        <form action="signup.php">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>

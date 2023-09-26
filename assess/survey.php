<?php
session_start();
include 'db_connect.php';

class SurveyPage {
    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function displayPage() {
        echo '<!DOCTYPE html>
            <html>
            <head>
                <title>Survey</title>
                <link rel="stylesheet" href="Css_files/survey.css">
            </head>
            <body>
                <div class="survey">
                    <h2>Welcome, ' . $this->username . '!</h2>
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
            </html>';
    }
}

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $surveyPage = new SurveyPage($username);
    $surveyPage->displayPage();
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responses = $_POST["response"];
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $status = 0;
    
        // Use prepared statements to insert responses into the database
        $stmt1 = $conn->prepare("UPDATE users1 SET survey_status=? WHERE username=?");
        
        // Bind parameters
        $stmt1->bind_param("ds", $status, $username);
    
        if ($stmt1->execute()) {
            // Response successfully stored
        } else {
            // Handle error if needed
            echo "Error storing response: " . $stmt1->error;
        }
    }
    // Loop through and store the responses in the database
    foreach ($responses as $response) {
        // Use prepared statements to insert responses into the database
        $stmt = $conn->prepare("INSERT INTO survey_responses (response_text) VALUES (?)");
        $stmt->bind_param("s", $response);

        if ($stmt->execute()) {
            // Response successfully stored
        } else {
            // Handle error if needed
            echo "Error storing response: " . $stmt->error;
        }
    }

    echo "Survey responses submitted successfully.";
}
?>

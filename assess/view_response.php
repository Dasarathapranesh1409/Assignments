<?php
session_start();
include 'db_connect.php';

// Retrieve survey responses from the database
$responses = []; // Initialize an empty array to store the responses


$sql = "SELECT * FROM survey_responses";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $responses[] = $row;
    }
} else {
    echo "No survey responses found in the database.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Survey Responses</title>
    <link rel="stylesheet" href="Css_files/view_response.css">
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>View Survey Responses</h2>
    
    <?php if (!empty($responses)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Response Text</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $response): ?>
                    <tr>
                        <td><?php echo $response['id']; ?></td>
                        <td><?php echo $response['response_text']; ?></td>
                        <td><?php echo $response['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
      
    <?php endif; ?>
    
    <br>
    <a href="survey.php">Back to Survey</a>
</body>
</html>

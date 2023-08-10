<?php
// view_responses.php

session_start();
include 'db_connect.php';

// Retrieve all survey questions from the database
$surveyQuery = "SELECT * FROM survey_questions";
$surveyResult = $conn->query($surveyQuery);

$surveyQuestions = [];
while ($questionRow = $surveyResult->fetch_assoc()) {
    $questionId = $questionRow["id"];
    $questionRow["options"] = json_decode($questionRow["options"], true);
    $surveyQuestions[] = $questionRow;
}

// Fetch the stored survey responses from the database
$fetchResponsesQuery = "SELECT * FROM survey_responses";
$responseResult = $conn->query($fetchResponsesQuery);

$storedResponses = [];
while ($responseRow = $responseResult->fetch_assoc()) {
    $storedResponses[] = $responseRow;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey Responses</title>
    <link rel="stylesheet" href="Css_files/view_response1.css">
</head>
<body>
    <div class="preview-survey">
        <h2>Survey Responses</h2>
        <?php if (isset($storedResponses) && count($storedResponses) > 0) { ?>
            <table>
                <tr>
                    <th>Question</th>
                    <th>Response</th>
                </tr>
                <?php foreach ($storedResponses as $response) { ?>
                    <?php
                        // Get the corresponding question for the response
                        $questionId = $response["question_id"];
                        $question = array_filter($surveyQuestions, function($q) use ($questionId) {
                            return $q["id"] === $questionId;
                        });
                        if (count($question) > 0) {
                            $question = reset($question);
                    ?>
                        <tr>
                            <td><?php echo $question["question"]; ?></td>
                            <td>
                                <?php
                                    // Display the response based on the question type
                                    if ($question["question_type"] === 'star_rating' || $question["question_type"] === 'free_text') {
                                        $responseValue = json_decode($response["response"], true);
                                        echo $responseValue;
                                    } else {
                                        echo $response["response"];
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>No survey responses yet.</p>
        <?php } ?>
        <form action="create_survey.php">
            <input type="submit" value="Back to Edit">
        </form>
    </div>
</body>
</html>

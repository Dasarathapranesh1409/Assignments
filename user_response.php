<?php
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

// Process the survey responses if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_survey'])) {
    foreach ($surveyQuestions as $question) {
        $questionId = $question["id"];
        if (isset($_POST['questions'][$questionId])) {
            $response = $_POST['questions'][$questionId];

            // For star_rating and free_text questions, the response is stored differently
            if ($question["question_type"] === 'star_rating' || $question["question_type"] === 'free_text') {
                $response = json_encode($response);
            }

            // Save the response in the database
            $insertResponseQuery = "INSERT INTO survey_responses (question_id, response) VALUES ('$questionId', '$response')";
            $conn->query($insertResponseQuery);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey Preview</title>
    <link rel="stylesheet" href="preview1.css">
    <style>
        /* CSS style for star rating display ... (same as before) */
    </style>
</head>
<body>
    <div class="preview-survey">
        <h2>Survey Preview</h2>
        <form action="preview.php" method="post">
            <?php foreach ($surveyQuestions as $question) { ?>
                <div class="question">
                    <p><?php echo $question["question"]; ?></p>
                    <?php if ($question["question_type"] === 'multiple_choice'/* || $question["question_type"] === 'dropdown'*/ ) { ?>
                        <?php foreach ($question["options"] as $option) { ?>
                            <label>
                                <input type="radio" name="questions[<?php echo $question["id"]; ?>]" value="<?php echo $option; ?>">
                                <?php echo $option; ?>
                            </label><br>
                        <?php } ?>
                        <?php } elseif ($question["question_type"] === 'dropdown') { ?>
                        <select name="questions[<?php echo $question["id"]; ?>]">
                            <?php foreach ($question["options"] as $option) { ?>
                                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                            <?php } ?>
                        </select>
                    <?php } elseif ($question["question_type"] === 'star_rating') { ?>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="questions[<?php echo $question["id"]; ?>]" value="5">
                            <label for="star5" class="star">&#9733;</label>
                            <input type="radio" id="star4" name="questions[<?php echo $question["id"]; ?>]" value="4">
                            <label for="star4" class="star">&#9733;</label>
                            <input type="radio" id="star3" name="questions[<?php echo $question["id"]; ?>]" value="3">
                            <label for="star3" class="star">&#9733;</label>
                            <input type="radio" id="star2" name="questions[<?php echo $question["id"]; ?>]" value="2">
                            <label for="star2" class="star">&#9733;</label>
                            <input type="radio" id="star1" name="questions[<?php echo $question["id"]; ?>]" value="1">
                            <label for="star1" class="star">&#9733;</label>
                        </div>
                    <?php } elseif ($question["question_type"] === 'free_text') { ?>
                        <input type="text" name="questions[<?php echo $question["id"]; ?>]">
                    <?php } ?>
                </div>
            <?php } ?>
            <input type="submit" name="submit_survey" value="Submit Survey">
        <!-- </form>
        <form action="create_survey.php">
            <input type="submit" value="Back to Edit"><br><br>
        </form> -->
    </div>

</body>
</html>

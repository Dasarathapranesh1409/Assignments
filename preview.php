<!-- <?php
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
    <link rel="stylesheet" href="preview.css">
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
                        <?php for ($i = 5; $i >= 1; $i--) { ?>
            <input type="radio" id="star_<?php echo $question["id"]; ?>_<?php echo $i; ?>"
                   name="questions[<?php echo $question["id"]; ?>]" value="<?php echo $i; ?>">
            <label for="star_<?php echo $question["id"]; ?>_<?php echo $i; ?>" class="star">&#9733;</label>
        <?php } ?>
    
                        </div>
                    <?php } elseif ($question["question_type"] === 'free_text') { ?>
                        <input type="text" name="questions[<?php echo $question["id"]; ?>]">
                    <?php } ?>
                </div>
            <?php } ?>
            <input type="submit" name="submit_survey" value="Submit Survey">
        </form>
        <form action="create_survey.php">
            <input type="submit" value="Back to Edit"><br><br>
        </form>
         <form action="view_response.php">
            <input type="submit" value="view report">
    

</body>
</html> -->










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
                if (is_array($response)) {
                    $response = json_encode($response);
                }
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
    <link rel="stylesheet" href="Css_files/preview1.css">
    
</head>
<body>
    <div class="preview-survey">
        <h2>Survey Preview</h2>
        <form action="preview.php" method="post">
            <?php foreach ($surveyQuestions as $question) { ?>
                <div class="question">
                    <p><?php echo $question["question"]; ?></p>
                    <?php if ($question["question_type"] === 'multiple_choice') { ?>
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
                            <fieldset class="rating">
                                <?php for ($i = 5; $i >= 1; $i--) { ?>
                                    <input type="radio" id="star_<?php echo $question["id"]; ?>_<?php echo $i; ?>"
                                           name="questions[<?php echo $question["id"]; ?>]" value="<?php echo $i; ?>">
                                    <label for="star_<?php echo $question["id"]; ?>_<?php echo $i; ?>" title="<?php echo $i; ?> star" class="star">&#9733;</label>
                                <?php } ?>
                            </fieldset>
                        </div>
                    <?php } elseif ($question["question_type"] === 'free_text') { ?>
                        <input type="text" name="questions[<?php echo $question["id"]; ?>]">
                    <?php } ?>
                </div>
            <?php } ?>
            <input type="submit" name="submit_survey" value="Submit Survey">
        </form>
        
    </div>
</body>
</html>


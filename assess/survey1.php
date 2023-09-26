<?php
session_start();
include 'db_connect.php';

// Retrieve survey questions from the database
$questions = []; // This array should be populated with survey questions from your database
$sql = "SELECT * FROM survey_questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    echo "No survey questions found in the database.";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Survey</title>
    <link rel="stylesheet" href="Css_files/preview.css">
</head>
<body>
    <div class="take-survey">
        <h2>Take Survey</h2>
        <form action="submit_survey.php" method="post">
            <?php foreach ($questions as $question): ?>
                <p><?php echo $question['question']; ?></p>

                <?php if ($question['question_type'] === 'multiple_choice' && $question['question_type'] === 'dropdown'): ?>
                    <select name="response[]">
                        <?php foreach (json_decode($question['options']) as $option): ?>
                            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="text" name="response[]">
                <?php endif; ?>

            <?php endforeach; ?>

            <input type="submit" value="Submit Survey">
        </form>
    </div>
</body>
</html>

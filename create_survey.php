 <?php
session_start();
include 'db_connect.php';

// Check if the user is logged in. If not, redirect to the login page.
// if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $question_type = $_POST["question_type"];
    $mandatory = isset($_POST["mandatory"]) ? 1 : 0;

    // Handle options for multiple-choice and dropdown questions
    $options = [];
    if ($question_type === "multiple_choice" || $question_type === "dropdown") {
        $options = $_POST["options"];
    }

    // Insert the new survey question into the database, including options
    $stmt = $conn->prepare("INSERT INTO survey_questions (question, question_type, mandatory, options) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $question, $question_type, $mandatory, json_encode($options));

    if ($stmt->execute()) {
        $question_id = $stmt->insert_id;
        echo "Survey question added successfully.";
    } else {
        echo "Error adding survey question: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create a New Survey</title>
    <link rel="stylesheet" href="Css_files/create_survey.css">
</head>
<body>
    <div class="create-survey">
        <h2>Create a New Survey</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label>Survey Question:</label>
            <input type="text" name="question" required>
            <br>
            <label>Question Type:</label>
            <select name="question_type" required>
                <option value="free_text">Free Text</option>
                <option value="dropdown">Dropdown</option>
                <option value="star_rating">Star Rating</option>
                <option value="multiple_choice">Multiple Choice</option>
            </select>
            <br>
            <label>Make Question Mandatory:</label>
            <input type="checkbox" name="mandatory">
            <br>
            <div id="options-container" style="display: none;">
                <!-- Options will be added dynamically using JavaScript for multiple_choice and dropdown questions -->
            </div>
            <br>
            <input type="submit" value="Add Question">
        </form>
        <br>
        <a href="survey.php">Back to Survey</a>
        <br>
        <form action="preview.php" method="post">
            <input type="submit" value="Preview">
        </form>
        <form action="view_response.php">
            <input type="submit" value="view report">
        </form>
    </div>
    

    <script>
        const questionTypeSelect = document.querySelector('select[name="question_type"]');
        const optionsContainer = document.getElementById('options-container');

        questionTypeSelect.addEventListener('change', function () {
            const selectedType = this.value;
            if (selectedType === 'multiple_choice' || selectedType === 'dropdown') {
                optionsContainer.style.display = 'block';
                addOptionInputs(4); // Add four option input fields for multiple-choice and dropdown questions
            } else {
                optionsContainer.style.display = 'none';
                optionsContainer.innerHTML = '';
            }
        });

        function addOptionInputs(count) {
            optionsContainer.innerHTML = '';

            for (let i = 0; i < count; i++) {
                const optionInput = document.createElement('input');
                optionInput.type = 'text';
                optionInput.name = 'options[]';
                optionInput.placeholder = 'Option ' + (i + 1);
                optionInput.required = true;

                optionsContainer.appendChild(document.createElement('br'));
                optionsContainer.appendChild(optionInput);
            }
        }
    </script>
</body>
</html>
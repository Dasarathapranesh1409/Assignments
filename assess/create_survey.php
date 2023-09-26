<?php
session_start();
include 'db_connect.php';

class SurveyQuestionCreator {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    public function createQuestion($question, $question_type, $mandatory, $options) {
        $stmt = $this->conn->prepare("INSERT INTO survey_questions (question, question_type, mandatory, options) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $question, $question_type, $mandatory, json_encode($options));

        if ($stmt->execute()) {
            return "Survey question added successfully.";
        } else {
            return "Error adding survey question: " . $stmt->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $question_type = $_POST["question_type"];
    $mandatory = isset($_POST["mandatory"]) ? 1 : 0;
    
    // Handle options for multiple-choice and dropdown questions
    $options = [];
    if ($question_type === "multiple_choice" || $question_type === "dropdown") {
        $options = $_POST["options"];
    }

    $questionCreator = new SurveyQuestionCreator($conn);
    $result_message = $questionCreator->createQuestion($question, $question_type, $mandatory, $options);

    echo $result_message;
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
        <form action="survey1.php" method="post">
            <input type="submit" value="Preview">
        </form>
        <form action="view_response.php">
            <input type="submit" value="View Report">
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

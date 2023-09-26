<?php
session_start();
include 'db_connect.php';

class UserRegistration {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    public function registerUser($username, $email, $password) {
        // Check if the username or email already exists in the database
        $check_sql = "SELECT * FROM users1 WHERE username = ? OR email = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            return "Error: Username or email already exists.";
        }

        // If the username and email are not found, proceed with registration
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
        $status = 1;
        $sql = "INSERT INTO users1 (username, email, password,survey_status) VALUES (?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssd", $username, $email, $hashed_password,$status);

            if ($stmt->execute()) {
                return "Signup successful. You can now login.";
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"]; 

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "Error: Password and confirm password do not match.";
    } else {
        $userRegistration = new UserRegistration($conn);
        $result_message = $userRegistration->registerUser($username, $email, $password);

        echo $result_message;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="Css_files/signup.css">
    <script>
        // JavaScript validation to check if password and confirm password match
        function validatePassword() {
            var password = document.forms["signupForm"]["password"].value;
            var confirm_password = document.forms["signupForm"]["confirm_password"].value;

            if (password !== confirm_password) {
                alert("Password and confirm password do not match.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="sign">
    <h2>Signup</h2>
    <form name="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validatePassword();">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>
        <input type="submit" value="Signup"><br><br>
    </form>
    <form action="userlogin.php">
        <input type="submit" value="Login">
    </form>
</div>  
</body>
</html>

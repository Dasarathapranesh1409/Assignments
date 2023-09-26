<?php
session_start();
include 'db_connect.php';

class UserAuthentication {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    public function login($user, $password) {
        // Using prepared statements to avoid SQL injection
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $user, $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];

                return true; // Login successful
            }
        }
        
        return false; // Login failed
    }
}

if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
    // User is already logged in, redirect to survey.php
    header("Location: survey.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];

    $userAuthentication = new UserAuthentication($conn);
    if ($userAuthentication->login($user, $password)) {
        header("Location: survey.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="Css_files/login.css">
</head>
<body>
<div class="log">
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label>Username or Email:</label>
        <input type="text" name="user" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>

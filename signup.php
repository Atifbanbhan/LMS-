<!DOCTYPE html>
<html>
<head>
  <title>Registration Processing</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $id = $_POST["id"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Validate and sanitize data (you should add more validation)
    $fullname = htmlspecialchars($fullname);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $id = htmlspecialchars($id);

    // Perform password matching and hash the password
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Database connection and insertion code (you need to customize this)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "skill_forge_academy";
    }
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO user (full_name, email, id, password) VALUES ('$fullname', '$email', '$id', '$password','$hashedPassword');

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close(); 
    }
}

?>
</body>
</html>
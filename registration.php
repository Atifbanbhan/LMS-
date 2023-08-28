<?php

$servername = "localhost";
$username = "root"; // Replace with your actual DB username
$password = ""; // Replace with your actual DB password
$dbname = "skill_forge_academy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input data and sanitize
$fullname = mysqli_real_escape_string($conn, $_POST['full_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$password = $_POST['password'];

// Hash the password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute the SQL statement using prepared statements
$sql = "INSERT INTO user (full_name, email, id, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $id, $passwordHash);
$result = $stmt->execute();

if ($result) {
    echo "Registration successful!";
    header("Location: login.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();

?>

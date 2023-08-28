<?php
// Database connection
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "skill_forge_academy";

//$conn = new mysqli($servername, $username, $password, $dbname);

//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

//if (isset($_POST['email'])) {
  //  $email = $_POST['email'];
  //  $password = $_POST['password'];

 //   $sql = "SELECT * FROM user WHERE email = '$email'";
 //  $result = $conn->query($sql);

 //   if ($result->num_rows > 0) {
   //         while($row = mysqli_fetch_assoc($result)){
   //     header("Location: Dashboard.html");
   //     exit();
 //   } else {
  //      echo "<script>alert('Invalid email or password. Please try again.');</script>";
  //  }
//}
//}

//$conn->close();

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ums_db";

// Get POST values
$em = isset($_POST["email"]) ? $_POST["email"] : '';
$pw = isset($_POST["pass"]) ? $_POST["pass"] : '';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM adminsignup WHERE email = '".$em."'";

$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    // echo "I am hefre 01";
    header("Location: ../adminDashbord/index.html");

    die();
    if (password_verify($pw, $row["pass"])) {
      echo "OK, you are logged in.<br>";
      $_SESSION['loggedin'] = "YES";
      $_SESSION['email'] = $row["email"];
      // header("Location: ../adminDashbord/index.html");

      // echo "<a href='dashboard.php'>Click here to go to the dashboard!</a>";
    } else {
      echo "Invalid password.<br>";
    }
  }
} else {
  echo "Sorry, email not found in our system.<br>";
  echo "Please register.<br>";
  $_SESSION['loggedin'] = "NO";
}

//mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $course = $_POST['course'];
  $address = $_POST['address'];

  $sql = "INSERT INTO student (fullname, email, phone, gender, course, address)
          VALUES ('$name', '$email', '$phone', '$gender', '$course', '$address')";

  if ($conn->query($sql) === TRUE) {
    header("Location: success.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
$conn->close();
?>
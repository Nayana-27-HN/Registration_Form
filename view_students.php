<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentdb";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registered Students</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="view-container">
    <h2>Registered Students</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Course</th>
        <th>Address</th>
      </tr>
      <?php
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['fullname']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['phone']}</td>
                  <td>{$row['gender']}</td>
                  <td>{$row['course']}</td>
                  <td>{$row['address']}</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No students registered yet.</td></tr>";
      }
      $conn->close();
      ?>
    </table>
  </div>
</body>
</html>
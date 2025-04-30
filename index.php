<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "phpimagedb";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// For demo, let's fetch the latest user
$sql = "SELECT * FROM insideimagedb ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $username = $row['username'];
  $image = $row['image'];

  echo "<h2>Welcome, $username!</h2>";
  echo "<img src='indeximage/$image' alt='Profile Image' style='width:200px;height:200px;border-radius:50%;border:2px solid white;'>";
} else {
  echo "No user found.";
}

$conn->close();
?>
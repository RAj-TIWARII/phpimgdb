<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "phpimagedb";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$success = false;
$userData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  $folder = "indeximage/" . basename($image);

  if (move_uploaded_file($tmp, $folder)) {
    $sql = "INSERT INTO insideimagedb (username, password, image) VALUES ('$username', '$password', '$image')";
    if ($conn->query($sql) === TRUE) {
      $success = true;

      // Fetch the just-inserted data
      $lastId = $conn->insert_id;
      $result = $conn->query("SELECT * FROM insideimagedb WHERE id = $lastId");
      if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>One Page Form + Upload</title>
</head>
<body style="background:#111;color:white;font-family:sans-serif;text-align:center;padding-top:50px;">
  <h2>Submit Your Profile</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <input type="submit" value="Submit" style="padding:10px 20px;"><br><br>
  </form>

  <?php if ($success && $userData): ?>
    <script>alert('Form submitted successfully!');</script>
    <h3>Welcome, <?php echo htmlspecialchars($userData['username']); ?>!</h3>
    <img src="indeximage/<?php echo htmlspecialchars($userData['image']); ?>" 
         alt="Profile Image" 
         style="width:200px;height:200px;border-radius:50%;border:3px solid white;box-shadow:0 0 15px white;">
  <?php endif; ?>
</body>
</html>
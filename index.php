<?php
// Start of the file
$localhost = 'localhost';
$root = 'root';
$password = '';
$db = 'phpimagedb';

// Connect to MySQL
$con = mysqli_connect($localhost, $root, $password, $db);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Form submission handling
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $userpass = $_POST['password'];
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target_dir = "uploads/";
        $target_path = $target_dir . $image;

        // Create directory if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            echo "<script>alert('Failed to upload image')</script>";
            exit;
        }
    }
	
	
	

    // Insert into DB
    $query = "INSERT INTO insideimagedb (username, password, image) VALUES ('$username', '$userpass', '$image')";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Record submitted successfully!')</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgb(255, 255, 255), rgba(255, 255, 255, 0.801)), url(images/bst.jpg);
            background-attachment: fixed;
            background-size: cover;
            color: black;
            padding: 22px;
        }
        .form-control {
            border-radius: 20px;
            margin-top: 11px;
        }
        ::placeholder {
            color: rgb(7, 7, 7) !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mb-4">Student Registration</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-3">
                            <input type="submit" name="submit" value="Submit" class="btn btn-info rounded-pill w-100">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="container-fluid fixed-bottom bg-dark text-white text-center p-2">
        <div class="row">
            <div class="col">f</div>
            <div class="col">f</div>
            <div class="col">f</div>
            <div class="col">f</div>
        </div>
    </footer>
</body>
</html>



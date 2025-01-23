<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// admin_signup.php
$showalert = false;
$showerror = false;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];
    $admin_cpassword = $_POST['cpassword'];

    // Check if username already exists
    $admin_existssql = "SELECT * FROM `admins` WHERE username = ?";
    $stmt = $conn->prepare($admin_existssql);
    if ($stmt) {
        $stmt->bind_param("s", $admin_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin_numexistsrows = $result->num_rows;

        if ($admin_numexistsrows > 0) {
            $showerror = "Username already exists!";
        } else {
            if ($admin_password == $admin_cpassword) {
              //  $admin_hash = password_hash($admin_password, PASSWORD_DEFAULT);
              $admin_hash=$admin_password;
                $sql = "INSERT INTO `admins` (`username`, `password`, `dt`) VALUES (?, ?, current_timestamp())";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ss", $admin_username, $admin_hash);
                    $result = $stmt->execute();

                    if ($result) {
                        $showalert = true;
                    } else {
                        $showerror = "Error: " . $stmt->error;
                    }
                } else {
                    $showerror = "Error preparing statement for insert: " . $conn->error;
                }
            } else {
                $showerror = "Passwords do not match!";
            }
        }
        $stmt->close();
    } else {
        $showerror = "Error preparing statement for username check: " . $conn->error;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN SIGNUP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php require 'partials/_nav.php'; ?>
<?php
if ($showalert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You have successfully signed up.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
if ($showerror) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> '. $showerror.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>
<div class="container my-4">
    <h1 class="text-center">ADMIN Signup</h1>
    <form action="admin_signup.php" method="post"> <!-- Corrected form action -->
        <div class="form-group">
            <label for="username" class="form-label">ADMIN Username</label>
            <input type="text" maxlength="15" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" maxlength="23" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" maxlength="23" class="form-control" id="cpassword" name="cpassword">
        </div>
        <button type="submit" class="btn btn-primary my-3">Sign Up</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

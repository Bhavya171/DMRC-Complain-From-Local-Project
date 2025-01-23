<?php
// admin_dashboard.php

session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complain_form"; // The database where the complaints are stored

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM dmrc_complain";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['admin_username']; ?></h2>
    <h3>Complaint List</h3>
    <table border="1">
        <tr>
            <!-- <th>Name</th> -->
            <th>E-mail</th>
            <th>Date</th>
            <th>Department</th>
            <th>Issue</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                // echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $row['issue'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No complaints found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

<?php
// db_connect.php - Database connection file

$host = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty, modify if you changed it
$database = "auth_system";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment this line for testing
// echo "Database connected successfully";
?>
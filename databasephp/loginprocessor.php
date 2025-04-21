<?php
// Start session
session_start();

// Include database connection and functions
require_once 'db.php';
require_once 'functions.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /*Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error'] = "Invalid form submission";
        header("Location: login.php");
        exit;
    }*/
    
    // Get form data and sanitize
    $username = trim(htmlspecialchars($_POST['username']));
    $password = $_POST['password'];
    
    // Check if username/email and password are provided
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username/email and password are required";
        header("Location: login.php");
        exit;
    }
    
    // Check if input is email or username
    $is_email = filter_var($username, FILTER_VALIDATE_EMAIL);
    
    // Prepare SQL statement based on input type
    if ($is_email) {
        $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ?");
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a new session
            session_regenerate_id();
            
            // Store user data in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedin'] = true;
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Invalid password";
            header("Location: login.php");
            exit;
        }
    } else {
        // Username/email not found
        $_SESSION['error'] = "User not found";
        header("Location: login.php");
        exit;
    }
    
    // Close statement
    $stmt->close();
} else {
    // If not POST request, redirect to login page
    header("Location: login.php");
    exit;
}

// Close connection
$conn->close();
?>
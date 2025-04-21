<?php
// Start session
session_start();

// Include functions
require_once 'functions.php';

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

/* Generate CSRF token
$csrf_token = generateCSRFToken();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1>Login</h1>

            <?php
            // Display error message if any
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            
            // Display success message if any
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>

            
            <form action="loginprocessor.php" method="POST">
              <div class="form-group">
                  <label for="username">Username or Email</label>
                  <input type="text" id="username" name="username" required>
              </div>
              
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" required>
              </div>
              
              <div class="button-group">
                  <button type="submit" class="btn btn-primary">Login</button>
              </div>
          </form>
          
          <div class="form-footer">
              Don't have an account? <a href="signup.php">Sign up here</a>
          </div>
      </div>
  </div>
</body>
</html>
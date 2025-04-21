<?php
// Start session
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1>Create an Account</h1>
            <?php
            // Display error message if any
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            <form action="signupprocessor.php" method="POST">
              <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" id="username" name="username" required>
              </div>
              
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required>
              </div>
              
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" required>
              </div>
              
              <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" id="confirm_password" name="confirm_password" required>
              </div>
              
              <div class="button-group">
                  <button type="submit" class="btn btn-primary">Sign Up</button>
              </div>
          </form>
          
          <div class="form-footer">
              Already have an account? <a href="login.php">Login here</a>
          </div>
      </div>
  </div>
</body>
</html>
<?php
require_once('connect.php');

// Initialize error message
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a SQL query to check the user's credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, credentials are correct
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username; // Set the username in the session
        header("Location: dashboard.php");
        exit();
    } else {
        $sqlUsernameCheck = "SELECT * FROM users WHERE username = '$username'";
        $resultUsernameCheck = $conn->query($sqlUsernameCheck);

        if ($resultUsernameCheck->num_rows != 1) {
            // Incorrect username
            $error_message = "Incorrect username";
        } else {
            // Incorrect password
            $error_message = "Incorrect password";
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>User Login</title>
  <style>
    /* Additional styles specific to the login page can be added here */
    .error-message {
      color: #ff3333; /* Red */
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <header>
      <h1>User Login</h1>
    </header>

    <div class="login-box">
      <?php
      if (isset($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
      }
      ?>
      <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="login">Login</button>
      </form>
    </div>

    <footer>
      <p>&copy; 2023 Your Website</p>
    </footer>
  </div>
</body>

</html>

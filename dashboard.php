<?php
session_start();
require_once('connect.php');

// Check if the user is not logged in, redirect to login.php
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

// Get the user's information from the session
$username = $_SESSION['username'];

// Fetch the email from the database based on the username
$sql = "SELECT email, picture FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $email = isset($row['email']) ? $row['email'] : 'N/A';
} else {
    $email = 'N/A';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>User Dashboard</title>
</head>

<body>
    <header>
        <h1>User Dashboard</h1>
    </header>

    <div class="container">
        <div class="profile-section">
            
            <img src="Untitled.jpg" alt="Profile Picture">

            <ul>
                <li><strong>Username:</strong> <?php echo $username; ?></li>
                <li><strong>Email:</strong> <?php echo $email; ?></li>
            </ul>   
        </div>

        <div class="content-section">
            <h1>Welcome, <?php echo $username; ?>!</h1>
            
            <!-- Display a welcome message using JavaScript -->
            <script>
                alert("Welcome, <?php echo $username; ?>!");
            </script>

            <!-- Logout button -->
            <form action="logout.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Your Website</p>
    </footer>
</body>

</html>

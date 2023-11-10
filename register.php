<?php
require_once('connect.php');

if (isset($_POST['submit'])) {
    if ($conn) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $picture = $_POST['picture'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "INSERT INTO users (fullname, email, picture, username, password, regs_date)
        VALUES ('$fullname', '$email', '$picture', '$username', '$password', NOW())";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: login.php");
            exit();
        } else {
            $err[] = 'Registration Failed...' . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        die('Connection Failed: ' . mysqli_connect_error());
    }
}
?>

<?php
include('connect.php');


$firstname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; // Initialize to an empty string if not set
$session = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : false; // Initialize to false if not set

$id = isset($_SESSION['id']) ? $_SESSION['id'] : ''; // Initialize to an empty string if not set

$query = mysqli_query($conn, "SELECT id, count(id) as user_count FROM users");
$view = mysqli_fetch_array($query);
$user_count = $view['user_count'];

$image_query = mysqli_query($conn, "SELECT picture FROM users WHERE id = '$id' ");
$row = mysqli_fetch_array($image_query);
$picture = $row['picture'];

?>

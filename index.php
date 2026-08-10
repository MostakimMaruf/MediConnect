<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="css/index.css"> 
</head>
<body>


<?php
session_start();

require("../config/db-connect.php");
include 'include/header.php';
?>

<div class="overlay-wrapper">
    <div class="overlay"></div>
    <div class="container mt-6 content-right">
        <h1>Welcome to Doctor Appointment Booking System</h1>
        <p>Access healthcare service anytime from anywhere with this platform</p>
        
        <div class="mt-5">
            <?php if (isset($_SESSION['patient_id'])): ?>
                <a class="btn btn-primary" href="/p3/appointment/appoint.php" style="background-color: #2C5F8A;">Make an Appointment</a>
            <?php else: ?>
                <a class="btn btn-primary" style="background-color: #2C5F8A;" href="/p3/login.php">Login to Make an Appointment</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include 'include/footer.php';
?>
</body>
</html>

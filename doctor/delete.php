<?php
session_start();
require("../config/db-connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}


if (isset($_GET['doctor_id'])) {
    $doctor_id = $_GET['doctor_id'];


    $sql = "DELETE FROM doctor WHERE doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);

    if ($stmt->execute()) {
        echo "Doctor record deleted successfully";
        header("Location: ../admin/doctor_read.php");
        exit();
    } else {
        echo "Error deleting doctor record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid doctor ID.";
}
?>

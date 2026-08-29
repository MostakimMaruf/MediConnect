<?php
session_start();
require("../config/db-connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Check if appointment_id is set in the URL
if (isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    $sql = "DELETE FROM appointment WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        echo "Appointment deleted successfully";
        header("Location: read_appointment.php");
        exit();
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }

    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid appointment ID.";
}
?>

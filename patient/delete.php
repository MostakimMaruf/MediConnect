<?php 
require("../config/db-connect.php"); 

if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];

    $sql = "DELETE FROM patient WHERE patient_id=$patient_id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

    header("Location: ../admin/patient_read.php");
    exit();
} else {
    echo "Invalid patient ID.";
}
?>
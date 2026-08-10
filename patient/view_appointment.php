<?php
session_start();
require("../config/db-connect.php");
require("../include/admin_header.php");

if (!isset($_GET['appointment_id'])) {
    echo "<div class='container'><div class='alert alert-danger'>No appointment ID provided.</div></div>";
    require("../include/footer.php");
    exit();
}

$appointment_id = $_GET['appointment_id'];

$sql = "
    SELECT 
        a.*, 
        p.name AS patient_name, 
        d.name AS doctor_name, 
        s.category AS spec_category,
        d.fees AS doctor_fees
    FROM 
        appointment a
    JOIN 
        patient p ON a.patient_id = p.patient_id
    JOIN 
        doctor d ON a.doctor_id = d.doctor_id
    JOIN 
        specialization s ON a.spec_id = s.spec_id
    WHERE 
        a.appointment_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
    ?>
    <div class="container">
        <h1>Appointment Details</h1>
        <p>Patient Name: <?= htmlspecialchars($appointment['patient_name']) ?></p>
        <p>Doctor Name: <?= htmlspecialchars($appointment['doctor_name']) ?></p>
        <p>Specialization Category: <?= htmlspecialchars($appointment['spec_category']) ?></p>
        <p>Fees: <?= htmlspecialchars($appointment['doctor_fees']) ?></p>
        <p>Date: <?= htmlspecialchars($appointment['date']) ?></p>
        <p>Timeslot: <?= htmlspecialchars($appointment['timeslot']) ?></p>
        <p>Status: <span class="badge badge-success">Booked</span></p>
    </div>
    <?php
} else {
    echo "<div class='alert alert-danger'>No appointment found.</div>";
}

$stmt->close();
$conn->close();
require("../include/footer.php");
?>
</body>
</html>

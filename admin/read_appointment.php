<?php
session_start();
require("../config/db-connect.php");

// Fetch all appointments with patient, doctor, specialization names, and timeslot details
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
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Admin Dashboard</title>
</head>
<body>

<div class="container">
  <div class="row">
  <?php include 'appointment_sidebar.php';?>
    <div class="container">
        <h1>All Booked Appointments</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Specialization Category</th>
                    <th>Fees</th>
                    <th>Date</th>
                    <th>Timeslot</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($appointment['appointment_id']) ?></td>
                        <td><?= htmlspecialchars($appointment['patient_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['doctor_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['spec_category']) ?></td>
                        <td><?= htmlspecialchars($appointment['doctor_fees']) ?></td>
                        <td><?= htmlspecialchars($appointment['date']) ?></td>
                        <td><?= htmlspecialchars($appointment['timeslot']) ?></td>
                        <td><span class="badge badge-success">Booked</span></td>
                        <td><a href="delete.php?appointment_id=<?= htmlspecialchars($appointment['appointment_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
  </div>
</div>
    <?php
} else {
    echo "<div class='alert alert-danger'>No appointments found.</div>";
}

$conn->close();
require("../include/footer.php");
?>
</body>
</html>

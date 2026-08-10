<?php
session_start();

if (!isset($_SESSION['doctor_id'])) {
    header("Location: ../login.php");
    exit();
}

require("../config/db-connect.php");

$doctor_id = $_SESSION['doctor_id'];

$query = "
    SELECT 
        a.*, 
        p.name AS patient_name, 
        s.category AS spec_category
    FROM 
        appointment a
    JOIN 
        patient p ON a.patient_id = p.patient_id
    JOIN 
        specialization s ON a.spec_id = s.spec_id
    WHERE 
        a.doctor_id = ?
    ORDER BY 
        a.date DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Doctor Dashboard</title>
</head>
<body>

<div class="container offset-md-2">
  <div class="row">
  <?php include 'doc_sidebar.php';?>
    <div class="col-md-9 content">
      <h1 class="display-4 font-weight-bold text-dark mb-4">View your appointments!</h1>
      <div class="row">
        <?php
        // Check if appointments were found
        if ($result->num_rows > 0) {
            // Display each appointment
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Appointment with <?= htmlspecialchars($row['patient_name']) ?></h5>
                            <p class="card-text">Date: <?= htmlspecialchars($row['date']) ?></p>
                            <p class="card-text">Timeslot: <?= htmlspecialchars($row['timeslot']) ?></p>
                            <a href="../patient/view_appointment.php?appointment_id=<?= $row['appointment_id'] ?>" class="btn btn-info" style="background-color: #2C5F8A;">View Details</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='alert alert-info'>No appointments scheduled with you.</div>";
        }
        ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php
$stmt->close();
$conn->close();
?>

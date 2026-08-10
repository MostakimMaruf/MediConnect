<?php
session_start();

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../login.php");
    exit();
}

require("../config/db-connect.php");

$patient_id = $_SESSION['patient_id'];

// Prepare and execute the query to fetch appointments for the specific patient
$query = "
    SELECT 
        a.*, 
        d.name AS doctor_name, 
        s.category AS spec_category
    FROM 
        appointment a
    JOIN 
        doctor d ON a.doctor_id = d.doctor_id
    JOIN 
        specialization s ON a.spec_id = s.spec_id
    WHERE 
        a.patient_id = ?
    ORDER BY 
        a.date DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $patient_id);
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
  <title>Patient Dashboard</title>
</head>
<body>

<div class="container">
  <div class="row">
  <?php include 'patient_sidebar.php';?>
    <div class="col-md-9 content">
      <h1 class="display-4 font-weight-bold text-dark mb-4">View your appointments!</h1>
      <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-6 offset-md-1">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Appointment with Dr. <?= htmlspecialchars($row['doctor_name']) ?></h5>
                            <p class="card-text">Date: <?= htmlspecialchars($row['date']) ?></p>
                            <p class="card-text">Timeslot: <?= htmlspecialchars($row['timeslot']) ?></p>
                            <a href="view_appointment.php?appointment_id=<?= $row['appointment_id'] ?>" class="btn btn-info" style="background-color: #2C5F8A;">View Details</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='alert alert-info'>You have not booked any appointments.</div>";
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
require("../include/footer.php");
?>

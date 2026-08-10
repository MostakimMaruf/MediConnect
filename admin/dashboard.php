<?php
require("../config/db-connect.php");
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); 
    exit();
}

// Query to get the count of doctors
$doctor_count_query = "SELECT COUNT(*) AS count FROM doctor";
$doctor_count_result = $conn->query($doctor_count_query);
$doctor_count = $doctor_count_result->fetch_assoc()['count'];

// Query to get the count of patients
$patient_count_query = "SELECT COUNT(*) AS count FROM patient";
$patient_count_result = $conn->query($patient_count_query);
$patient_count = $patient_count_result->fetch_assoc()['count'];

// Query to get the count of appointments
$appointment_count_query = "SELECT COUNT(*) AS count FROM appointment";
$appointment_count_result = $conn->query($appointment_count_query);
$appointment_count = $appointment_count_result->fetch_assoc()['count'];

$conn->close();
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
<div class="container-fluid">
  <div class="row">
    <?php include 'admin_sidebar.php'; ?>
    <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <h1 class="display-4 font-weight-bold text-dark mb-4">Welcome to the Admin Dashboard!!!</h1>
      <div class="row">
        <div class="col-md-4 mb-4">
          <form action="doctor_read.php" method="get">
            <button type="submit" class="card bg-primary text-white p-4 w-100 border-0">
              <div class="card-body">
                <h2 class="card-title">Doctors</h2>
                <p class="card-text display-4"><?= $doctor_count; ?></p>
                <p class="card-text">View Details</p>
              </div>
            </button>
          </form>
        </div>
        <div class="col-md-4 mb-4">
          <form action="patient_read.php" method="get">
            <button type="submit" class="card bg-success text-white p-4 w-100 border-0">
              <div class="card-body">
                <h2 class="card-title">Patients</h2>
                <p class="card-text display-4"><?= $patient_count; ?></p>
                <p class="card-text">View Details</p>
              </div>
            </button>
          </form>
        </div>
        <div class="col-md-4 mb-4">
          <form action="/p3/appointment/read_appointment.php" method="get">
            <button type="submit" class="card bg-danger text-white p-4 w-100 border-0">
              <div class="card-body">
                <h2 class="card-title">Appointments</h2>
                <p class="card-text display-4"><?= $appointment_count; ?></p>
                <p class="card-text">View Details</p>
              </div>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require("../include/footer.php"); ?>
</body>
</html>

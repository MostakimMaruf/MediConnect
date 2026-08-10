<?php
session_start();
require("../config/db-connect.php"); 

if (!isset($_SESSION['username'])) {
    header('Location:../index.php'); 
    exit();
}

$sql = "SELECT d.doctor_id, d.spec_id, d.name, d.contact, d.email, d.fees, s.category AS specialization 
        FROM doctor d 
        JOIN specialization s ON d.spec_id = s.spec_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Admin Dashboard</title>
  <style>
    .center-text {
        text-align: center;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <?php include 'admin_sidebar.php'; ?>
    <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <h1 class="mt-4 center-text">Doctor List</h1>
      <?php if ($result->num_rows > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Doctor ID</th>
                <th>Specialization</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Fees</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?= htmlspecialchars($row["doctor_id"]); ?></td>
                  <td><?= htmlspecialchars($row["specialization"]); ?></td>
                  <td><?= htmlspecialchars($row["name"]); ?></td>
                  <td><?= htmlspecialchars($row["contact"]); ?></td>
                  <td><?= htmlspecialchars($row["email"]); ?></td>
                  <td><?= htmlspecialchars($row["fees"]); ?></td>
                  <td><a href="../doctor/update.php?doctor_id=<?= htmlspecialchars($row["doctor_id"]); ?>" class="btn btn-sm btn-success">Update</a></td>
                  <td><a href="../doctor/delete.php?doctor_id=<?= htmlspecialchars($row["doctor_id"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else { ?>
        <p>No doctors added yet!</p>
      <?php } ?>
      <a href="add_doctor.php" class="btn btn-primary mt-3" style="background-color: #2C5F8A;"></button>
      Add new Doctor</a>
    </div>
  </div>
</div>
<?php require("../include/footer.php"); ?>
</body>
</html>

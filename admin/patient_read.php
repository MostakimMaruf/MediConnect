<?php require("../config/db-connect.php"); ?>
<?php
$sql = "SELECT patient_id, name, username, password, blood_group, gender, contact, age FROM patient";
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
  <style>
    .center-text {
        text-align: center;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
  <?php include 'admin_sidebar.php';?>
  <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <h1 class="mt-4 center-text">Patient List</h1>
    <div class="container">
    <table class="table table-striped table-bordered">
        <tr>
            <td><b>patient_id</b></td>
            <td><b>name</b></td>
            <td><b>username</b></td>
            <td><b>blood_group</b></td>
            <td><b>gender</b></td>
            <td><b>contact</b></td>
            <td><b>age</b></td>
            <td><b>Update</b></td>
            <td><b>Delete</b></td>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row["patient_id"]; ?></td>
            <td><?= $row["name"]; ?></td>
            <td><?= $row["username"]; ?></td>
            <td><?= $row["blood_group"]; ?></td>
            <td><?= $row["gender"]; ?></td>
            <td><?= $row["contact"]; ?></td>
            <td><?= $row["age"]; ?></td>
            <td><a href="../patient/update.php?patient_id=<?= htmlspecialchars($row["patient_id"]); ?>" class="btn btn-sm btn-success">Update</a></td>
            <td><a href="../patient/delete.php?patient_id=<?= htmlspecialchars($row["patient_id"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
            
        </tr>
        <?php
        }
        ?>
    </table>
    <?php   
    } else {
    ?>
    <p>0 results</p>
    <?php
    }
    $conn->close();
    ?> 
    </div>
  </div>
</div>

<?php require("../include/footer.php"); ?>
</body>

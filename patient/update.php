<?php require("../config/db-connect.php"); ?>

<?php
if (isset($_POST['update'])) {    
    $patient_id = $_POST['patient_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $blood_group = $_POST['blood_group'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];

    $sql = "UPDATE patient SET name='$name', username='$username', password='$password', blood_group='$blood_group', gender='$gender', contact='$contact', age='$age' WHERE patient_id=$patient_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/patient_read.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];

    $sql = "SELECT * FROM patient WHERE patient_id=$patient_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $username = $row['username'];
            $blood_group = $row['blood_group'];
            $gender = $row['gender'];
            $contact = $row['contact'];
            $age = $row['age'];
        }
    } else {
        echo "No record found";
    }
} else {
    echo "Invalid patient ID";
}
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
    <div class="col-md-3 sidebar bg-white">
      <div class="p-4">
        <button class="btn btn-primary btn-block mb-4">Patients</button>
        <ul class="list-unstyled">
        <li class="mb-2"><a href="../index.php" class="text-decoration-none text-dark d-block py-2 px-4 rounded hover-bg-light">Home</a></li>
          <li class="mb-2"><a href="../admin/dashboard.php" class="text-decoration-none text-dark d-block py-2 px-4 rounded hover-bg-light">Admin Dashboard</a></li>
          <li class="mb-2"><a href="../logout.php" class="text-decoration-none text-dark d-block py-2 px-4 rounded hover-bg-light">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class="container">
        <form name="update_user" method="post" action="update.php">
            <table class="table table-striped" border="0">
                <tr> 
                    <td>Name</td>
                    <td><input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td><input type="text" name="blood_group" value="<?php echo isset($blood_group) ? $blood_group : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><input type="text" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><input type="text" name="contact" value="<?php echo isset($contact) ? $contact : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><input type="text" name="age" value="<?php echo isset($age) ? $age : ''; ?>"></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="patient_id" value="<?php echo isset($patient_id) ? $patient_id : ''; ?>"></td>
                    <td><input type="submit" name="update" value="Update"></td>
                </tr>
            </table>
        </form>
    </div>
  </div>
</div>

<?php require("../include/footer.php"); ?>
</body>
</html>

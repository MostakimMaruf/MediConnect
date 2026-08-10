<?php 
require("../config/db-connect.php"); 

if(isset($_POST['update'])) {    
    $doctor_id = $_POST['doctor_id'];
    $spec_id = $_POST['spec_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $fees = $_POST['fees'];


    $stmt = $conn->prepare("UPDATE doctor SET spec_id=?, name=?, username=?, password=?, contact=?, email=?, fees=? WHERE doctor_id=?");
    $stmt->bind_param("issssssi", $spec_id, $name, $username, $password, $contact, $email, $fees, $doctor_id);

    if ($stmt->execute()) {
        header("Location: ../admin/doctor_read.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$doctor_id = $_GET['doctor_id'];
$sql = "SELECT * FROM doctor WHERE doctor_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $spec_id = $row['spec_id'];
    $name = $row['name'];
    $username = $row['username'];
    $contact = $row['contact'];
    $email = $row['email'];
    $fees = $row['fees'];
}

$stmt->close();

$sql = "SELECT spec_id, category FROM specialization";
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
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" required></td>
            </tr>
            <tr>
                <td>Fees</td>
                <td><input type="text" name="fees" value="<?php echo htmlspecialchars($fees); ?>" required></td>
            </tr>
            <tr>
                <td>Specialization</td>
                <td>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <input type="radio" id="spec<?php echo $row['spec_id']; ?>" name="spec_id" value="<?php echo $row['spec_id']; ?>" <?php echo ($spec_id == $row['spec_id']) ? 'checked' : ''; ?> required>
                            <label for="spec<?php echo $row['spec_id']; ?>"><?php echo htmlspecialchars($row['category']); ?></label><br>
                            <?php
                        }
                    } else {
                        echo "<p>No specializations found.</p>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>"></td>
                <td><input type="submit" name="update" value="Update" class="btn btn-primary"></td>
            </tr>
        </table>
    </form>
    </div>
  </div>
</div>
<?php require("../include/footer.php"); ?>
</body>
</html>

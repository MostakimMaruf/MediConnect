<?php
session_start();

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../login.php");
    exit();
}

require("../config/db-connect.php");
require("../include/admin_header.php");

$patient_id = $_SESSION['patient_id'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $blood_group = $_POST['blood_group'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];

    $sql = "UPDATE patient SET name=?, username=?, blood_group=?, gender=?, contact=?, age=? WHERE patient_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $username, $blood_group, $gender, $contact, $age, $patient_id);
    
    if ($stmt->execute()) {
        header("Location: pat_dash.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

$sql = "SELECT * FROM patient WHERE patient_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();
$stmt->close();
?>

<div class="container">
    <h1>Edit Profile</h1>
    <form name="update_user" method="post" action="edit_profile.php">
        <table class="table table-striped" border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo htmlspecialchars($patient['username']); ?>"></td>
            </tr>
            <tr>
                <td>Blood Group</td>
                <td><input type="text" name="blood_group" value="<?php echo htmlspecialchars($patient['blood_group']); ?>"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><input type="text" name="gender" value="<?php echo htmlspecialchars($patient['gender']); ?>"></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" name="contact" value="<?php echo htmlspecialchars($patient['contact']); ?>"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="age" value="<?php echo htmlspecialchars($patient['age']); ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($patient_id); ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</div>

<?php require("../include/footer.php"); ?>
</body>
</html>

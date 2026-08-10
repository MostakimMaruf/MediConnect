<?php
session_start();

if (!isset($_SESSION['doctor_id'])) {
    header("Location: ../login.php");
    exit();
}

require("../config/db-connect.php");
require("../include/admin_header.php"); 

$doctor_id = $_SESSION['doctor_id'];

if (isset($_POST['update'])) {
    $spec_id = $_POST['spec_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $fees = $_POST['fees'];

    $sql = "UPDATE doctor SET spec_id=?, name=?, username=?, email=?, contact=?, fees=? WHERE doctor_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssi", $spec_id, $name, $username, $email, $contact, $fees, $doctor_id);
    
    if ($stmt->execute()) {
        header("Location: doc_dash.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

$sql = "SELECT * FROM doctor WHERE doctor_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();
$stmt->close();

$sql = "SELECT spec_id, category FROM specialization";
$spec_result = $conn->query($sql);
?>

<div class="container">
    <h1>Edit Profile</h1>
    <form name="update_user" method="post" action="edit_profile.php">
        <table class="table table-striped" border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo htmlspecialchars($doctor['username']); ?>"></td>
            </tr>
            <tr>
                <td>Specialization</td>
                <td>
                <?php
                    if ($spec_result->num_rows > 0) {
                        while ($row = $spec_result->fetch_assoc()) {
                            ?>
                            <input type="radio" id="spec<?php echo $row['spec_id']; ?>" name="spec_id" value="<?php echo $row['spec_id']; ?>" <?php echo ($doctor['spec_id'] == $row['spec_id']) ? 'checked' : ''; ?> required>
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
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo htmlspecialchars($doctor['email']); ?>"></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" name="contact" value="<?php echo htmlspecialchars($doctor['contact']); ?>"></td>
            </tr>
            <tr>
                <td>Fees</td>
                <td><input type="text" name="fees" value="<?php echo htmlspecialchars($doctor['fees']); ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</div>

<?php require("../include/footer.php"); ?>
</body>
</html>

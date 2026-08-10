<?php
require("../config/db-connect.php");
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $sql = "UPDATE admin SET email = ?, contact = ? WHERE username = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $email, $contact, $username);
        if ($stmt->execute()) {
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM admin WHERE username = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Edit Profile</title>
</head>
<body>
<div class="container">
  <h1 class="mt-4">Edit Profile</h1>
  <form action="edit_profile.php" method="post">
    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required readonly>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
    </div>
    <div class="form-group">
      <label for="contact">Contact</label>
      <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($admin['contact']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
  </form>
</div>
</body>
</html>

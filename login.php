<?php 
session_start();
// require("../p3/config/db-connect.php");
require(".././mediconnect/config/db-connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'] ?? '';
    
    switch ($userType) {
        case 'doctor':
            $table = 'doctor';
            break;
        case 'patient':
            $table = 'patient';
            break;
        case 'admin':
            $table = 'admin';
            break;
        default:
            echo '<p class="text-danger text-center mt-3">Please select a user type.</p>';
            exit;
    }

    $sql = "SELECT * FROM $table WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password_from_db = $row['password'];

        if (password_verify($password, $hashed_password_from_db)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = $userType;

            // Redirect based on user type
            switch ($userType) {
                case 'doctor':
                    $_SESSION['doctor_id'] = $row['doctor_id'];
                    header('Location: doctor/doc_dash.php');
                    exit();
                case 'patient':
                    $_SESSION['patient_id'] = $row['patient_id'];
                    header('Location: patient/pat_dash.php');
                    exit();
                case 'admin':
                    $_SESSION['username'] = $row['username'];
                    header('Location: admin/dashboard.php');
                    exit();
            }
        } else {
            echo '<p class="text-danger text-center mt-3">Invalid username or password.</p>';
        }
    } else {
        echo '<p class="text-danger text-center mt-3">Invalid username or password.</p>';
    }

    $stmt->close();
    $conn->close();
}
?>
<?php include 'include/header.php';?>
<body>
  <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
      <div class="col-lg-6 d-none d-lg-flex bg-gradient align-items-center justify-content-center text-white text-center">
        <div>
          <h1 class="display-4 font-weight-bold mb-4" style="background-color: #2C5F8A;">Welcome Back!</h1>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">
        <div class="w-100 p-4 p-lg-5">
          <h2 class="mb-3 font-weight-bold text-dark">Log in</h2>
          <p class="text-muted mb-4">Welcome back! Please log into your account.</p>
          <form action="" method="post">
            <div class="form-group mb-4">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
            </div>
            <div class="form-group mb-4">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" name="userType" id="doctor" value="doctor" required>
              <label class="form-check-label" for="doctor">Doctor</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" name="userType" id="patient" value="patient" required>
              <label class="form-check-label" for="patient">Patient</label>
            </div>
            <div class="form-check mb-4">
              <input type="radio" class="form-check-input" name="userType" id="admin" value="admin" required>
              <label class="form-check-label" for="admin">Admin</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #2C5F8A; width: 100%;">Login</button>
          </form>
          <div class="text-center mt-3">
            <p class="text-muted">New patient? <a href="/signup.php" class="text-primary">Sign up</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'include/footer.php'; ?>
</body>
</html>

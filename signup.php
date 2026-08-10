<?php 
require("../p3/config/db-connect.php"); 
?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $blood_group = $_POST['blood_group'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO patient (name, username, password, blood_group, gender, contact, age) VALUES ('$name', '$username', '$hashed_password', '$blood_group', '$gender', '$contact', '$age')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match.";
    }

    $conn->close();
}
include 'include/header.php';
?>
  <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
      <div class="col-lg-6 d-none d-lg-flex bg-gradient align-items-center justify-content-center text-white text-center">
        <div>
          <h1 class="display-4 font-weight-bold mb-4" style="background-color: #2C5F8A;">Welcome to Doctor Appointment System!</h1>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">
        <div class="w-100 p-4 p-lg-5">
          <h2 class="mb-3 font-weight-bold text-dark">SignUp</h2>
          <p class="text-muted mb-4">Welcome! Sign up to our website.</p>
          <form id="signup-form" action="signup.php" method="post">
            <div class="form-group mb-4">
              <label for="name">Fullname</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-4">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group mb-4">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="form-group mb-4">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
            </div>
            <div class="form-group mb-4">
              <label for="blood_group">Blood Group</label>
              <select name="blood_group" class="form-control" id="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
              </select>
            </div>
            <div class="form-group mb-4">
              <label for="gender">Gender</label>
              <select name="gender" class="form-control" id="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group mb-4">
              <label for="contact">Contact</label>
              <input type="text" name="contact" class="form-control" id="contact" required>
            </div>
            <div class="form-group mb-4">
              <label for="age">Age</label>
              <input type="text" name="age" class="form-control" id="age" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #2C5F8A; width: 100%;" name="submit">SignUp</button>
            <?php if (isset($error_message)): ?>
              <div class="alert alert-danger mt-2" role="alert">
                <?php echo $error_message; ?>
              </div>
            <?php endif; ?>
          </form>
          <div class="text-center mt-3">
            <p class="text-muted">Already have an account? <a href="/p3/login.php" class="text-primary">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
include 'include/footer.php';
?>

</body>
</html>

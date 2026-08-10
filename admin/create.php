<?php require("../config/db-connect.php"); ?>
<?php require("../include/admin_header.php"); ?>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare the SQL statement
    $sql = "INSERT INTO admin (username, password, contact, email) VALUES (?, ?, ?, ?)";
    
    // Initialize a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("ssss", $username, $hashed_password, $contact, $email);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: ../login.php");
            exit();  
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
    
    // Close the connection
    $conn->close();
}
?>

<div class="container">
    <h1>Enter a new record for new Admin</h1>
    
    <form action="create.php" method="post">
        <div class="mb-3">
            <label for="exampleInputusername" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputusername" required>
            
            <label for="exampleInputpassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
            
            <label for="exampleInputcontact" class="form-label">Contact</label>
            <input type="text" name="contact" class="form-control" id="exampleInputcontact" required>
            
            <label for="exampleInputemail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputemail" required>
        </div>
        
        <input type="submit" class="btn btn-primary" name="Add" />
    </form>
</div>

</body>
</html>

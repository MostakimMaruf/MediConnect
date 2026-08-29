<?php require("../config/db-connect.php"); ?>
<?php require("../include/admin_header.php"); ?>
<?php 
    if(isset($_POST['submit'])){
        $Category = $_POST['category'];
        $sql = "INSERT INTO specialization (spec_id, category) VALUES ('', '$Category')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("location: read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>

<div class="container">
    <h1>Enter a new category for specialization</h1>
      
    <form action="crform.php" method="post">
        <div class="row mb-3 align-items-center">
            <div class="col-md-4">
                <label for="category" class="form-label">Category:</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="category" class="form-control" id="category" required>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" style="background-color: #2C5F8A;" name="submit" />
        <input type="text" name="spec_id" hidden /><br><br>
    </form>
</div>  

<?php require("../include/footer.php"); ?>
</body>
</html>

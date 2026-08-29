<?php require("../config/db-connect.php"); ?>
<?php
$sql = "SELECT spec_id, category FROM specialization";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
<div class="container">
<?php include 'admin_sidebar.php'; ?>
    <h1>List of Specializations</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <td><b>spec_id</b></td>
            <td><b>category</b></td>
            <td><b>Update</b></td>
            <td><b>Delete</b></td>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row["spec_id"]; ?></td>
            <td><?= $row["category"]; ?></td>
            <td><a href="update.php?spec_id=<?= htmlspecialchars($row["spec_id"]); ?>" class="btn btn-sm btn-success">Update</a></td>
            <td><a href="delete.php?spec_id=<?= htmlspecialchars($row["spec_id"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
            
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

<a href="crform.php"  class="btn btn-primary mt-3" style="background-color: #2C5F8A;"></button>Create new Category for specialization</a> 
 

</div>

<?php require("../include/footer.php"); ?>
</body>

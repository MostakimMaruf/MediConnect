<?php require("../config/db-connect.php"); ?>
<?php
$specID = $_GET['spec_id'];
 
$sql = ("DELETE FROM specialization WHERE spec_id=$specID");
 if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
$conn->close();
header("Location:read.php");
?>



<div class="container">
<form name="delete_user" method="post" action="delete.php">
    <table class= "table table-striped" border="0">
    <tr> 
	<td>category</td>
	<td><input type="text" name="category" value="<?php echo $category;?>"></td>
    </tr>
			
    <tr>
	<td><input type="hidden" name="spec_id" value= "<?php echo $_GET['spec_id'];?>" ></td>
	<td><input type="submit" name="delete" value="Delete"></td>
    </tr>
    </table>
</form>
</div>

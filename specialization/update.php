<?php require("../config/db-connect.php"); ?>
<?php require("../include/header.php"); ?>
<?php
if(isset($_POST['update']))
{	
	$specID = $_POST['spec_id'];
	
	$category=$_POST['category'];

	$sql = ("UPDATE specialization SET category='$category' WHERE spec_id=$specID");
	$result = $conn->query($sql);
	header("Location: read.php");
}

$specID = $_GET['spec_id'];

$sql = "SELECT * FROM specialization WHERE spec_id=$specID";
$result = $conn->query($sql);
while($row =$result->fetch_assoc()) 
{
	$category = $row['category'];
}
?>
<div class="container">
<form name="update_user" method="post" action="update.php">
    <table class= "table table-striped" border="0">
    <tr> 
	<td>category</td>
	<td><input type="text" name="category" value="<?php echo $category;?>"></td>
    </tr>
			
    <tr>
	<td><input type="hidden" name="spec_id" value= "<?php echo $_GET['spec_id'];?>" ></td>
	<td><input type="submit" name="update" value="Update"></td>
    </tr>
    </table>
</form>
</div>
<?php require("../include/footer.php"); ?>


<?php
require("../config/db-connect.php");?>


<?php
if (isset($_GET['spec_id'])) {
  $spec_id = intval($_GET['spec_id']);
    $doctor_sql = "SELECT doctor_id, name, fees FROM doctor WHERE spec_id = ?";


    $stmt = $conn->prepare($doctor_sql);
    $stmt->bind_param("i", $spec_id);
    $stmt->execute();


    $result = $stmt->get_result();
    
    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
    
    echo json_encode($doctors);
    $stmt->close();
}
$conn->close();
?>

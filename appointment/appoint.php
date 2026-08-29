<?php
session_start();
require("../config/db-connect.php");
require("../include/admin_header.php"); 

if (!isset($_SESSION['patient_id'])) {
    echo "<div class='container'><div class='alert alert-danger'>Login as patient to book appointment</div></div>";
    require("../include/footer.php");
    exit();
}

$specializations = [];
$doctors = [];
$message = "";
$spec_id = "";

// Fetch specializations
$spec_sql = "SELECT spec_id, category FROM specialization";
$spec_result = $conn->query($spec_sql);
if ($spec_result->num_rows > 0) {
    while ($spec_row = $spec_result->fetch_assoc()) {
        $specializations[] = $spec_row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $patient_id = $_SESSION['patient_id'];
        $doctor_id = $_POST['doctor_id'];
        $spec_id = $_POST['spec_id'];
        $date = $_POST['date'];
        $timeslot = $_POST['timeslot'];

        
        $sql = "INSERT INTO appointment (patient_id, doctor_id, spec_id, date, timeslot) VALUES (?, ?, ?, ?, ?)";
        
        
        $stmt = $conn->prepare($sql);
        
        
        $stmt->bind_param("iiiss", $patient_id, $doctor_id, $spec_id, $date, $timeslot);
        
        
        if ($stmt->execute()) {
            $appointment_id = $stmt->insert_id;
            
            header("Location: ../patient/pat_dash.php?appointment_id=$appointment_id");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
        
    
        $stmt->close();
    } elseif (isset($_POST['spec_id'])) {
        $spec_id = $_POST['spec_id'];

        // Fetch all doctors regardless of specialization
        $doctor_sql = "SELECT doctor_id, name, fees FROM doctor";
        $result = $conn->query($doctor_sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row;
            }
        }
    }
}
$conn->close();
?>

<div class="container d-flex justify-content-center">
    <div class="w-100" style="max-width: 500px;">
        <h1>Make an Appointment</h1>
        <form action="appoint.php" method="post">
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="spec_id" class="form-label">Specialization</label>
                    <select name="spec_id" id="spec_id" class="form-select" required onchange="handleSelectChange(event)">
                        <option selected disabled>Choose a specialization</option>
                        <?php
                        foreach ($specializations as $spec) {
                            $selected = isset($spec_id) && $spec_id == $spec['spec_id'] ? 'selected' : '';
                            echo "<option value='" . $spec['spec_id'] . "' $selected>" . $spec['category'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="doctor_id" class="form-label">Choose a Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="form-select" required>
                        <option selected disabled>Choose a doctor</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="date" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="timeslot" class="form-label">Timeslot</label>
                    <select name="timeslot" id="timeslot" class="form-select" required>
                        <option selected disabled>Choose a timeslot</option>
                        <option value="07:00:00">07:00:00 </option>
                        <option value="07:20:00">07:20:00 </option>
                        <option value="07:40:00">07:40:00</option>
                        <option value="08:00:00">08:00:00 </option>
                        <option value="09:00:00">09:00:00</option>
                        <option value="10:00:00">10:00:00 </option>
                        <option value="11:00:00 ">11:00:00 </option>
                        <option value="12:00:00">12:00:00</option>
                        <option value="13:00:00 ">13:00:00</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary w-100" style="background-color: #2C5F8A;" name="submit" value="Book Appointment" />
                </div>
            </div>
        </form>
    </div>
</div>

<?php require("../include/footer.php"); ?>

<script>
    function handleSelectChange(event) {
        const specId = event.target.value;
        console.log(specId);
        const xhr = new XMLHttpRequest();
        const url = `./get_doctorsby_spec.php?spec_id=${specId}`;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const doctorSelect = document.getElementById('doctor_id');
                doctorSelect.innerHTML = '<option selected disabled>Choose a doctor</option>'; // Clear previous options
                response.forEach(doctor => {
                    const option = document.createElement('option');
                    option.value = doctor.doctor_id;
                    option.textContent = `Name: ${doctor.name} - Fee: ${doctor.fees}`;
                    doctorSelect.appendChild(option);
                });
            }
        };

        xhr.send();
    }
</script>

</body>
</html>

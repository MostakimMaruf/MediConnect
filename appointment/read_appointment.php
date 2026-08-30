```php
<?php
session_start();
require("../config/db-connect.php");

// ----------------------------------------------------
// ADMIN LOGIN CHECK
// ----------------------------------------------------
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// ----------------------------------------------------
// FETCH APPOINTMENTS
// ----------------------------------------------------
$sql = "
    SELECT 
        a.appointment_id,
        a.patient_id,
        a.doctor_id,
        a.spec_id,
        a.date,
        a.timeslot,

        p.name AS patient_name,
        d.name AS doctor_name,
        d.fees AS doctor_fees,
        s.category AS spec_category

    FROM appointment a

    LEFT JOIN patient p
        ON a.patient_id = p.patient_id

    LEFT JOIN doctor d
        ON a.doctor_id = d.doctor_id

    LEFT JOIN specialization s
        ON a.spec_id = s.spec_id

    ORDER BY a.date DESC
";

$result = $conn->query($sql);

// Check SQL error
if (!$result) {
    die("
        <div style='
            font-family: Arial;
            padding: 30px;
            color: #721c24;
            background: #f8d7da;
            margin: 30px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
        '>
            <h2>Database Error</h2>
            <p>" . htmlspecialchars($conn->error) . "</p>
        </div>
    ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Appointments - MediConnect</title>

    <!-- Bootstrap 4 -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    >

    <style>

        body {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .top-navbar {
            background: #343a40;
            padding: 15px 25px;
            color: white;
        }

        .top-navbar .brand {
            font-size: 22px;
            font-weight: bold;
        }

        .top-navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .top-navbar a:hover {
            color: #17a2b8;
        }

        .main-container {
            padding: 30px;
        }

        .page-title {
            font-weight: bold;
            color: #343a40;
        }

        .subtitle {
            color: #6c757d;
        }

        .appointment-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-header-custom {
            background: #dc3545;
            color: white;
            padding: 18px 20px;
        }

        .card-header-custom h4 {
            margin: 0;
            font-weight: bold;
        }

        table {
            margin-bottom: 0 !important;
        }

        table th {
            white-space: nowrap;
            vertical-align: middle !important;
        }

        table td {
            vertical-align: middle !important;
        }

        .badge-booked {
            background-color: #28a745;
            color: white;
            padding: 7px 12px;
            border-radius: 20px;
        }

        .delete-btn {
            min-width: 70px;
        }

        .empty-box {
            background: white;
            padding: 50px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .empty-box h3 {
            color: #6c757d;
        }

        .footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            color: #6c757d;
        }

    </style>

</head>

<body>


<!-- =====================================================
     TOP NAVIGATION
===================================================== -->

<nav class="top-navbar">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center">

            <div class="brand">
                MediConnect Admin
            </div>

            <div>

                <a href="../index.php">
                    Dashboard
                </a>

                <a href="doctor_read.php">
                    Doctors
                </a>

                <a href="patient_read.php">
                    Patients
                </a>

                <a href="read_appointment.php">
                    Appointments
                </a>

                <a href="../logout.php">
                    Logout
                </a>

            </div>

        </div>

    </div>

</nav>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="main-container">

    <div class="container-fluid">


        <!-- PAGE HEADER -->

        <div class="mb-4">

            <h1 class="page-title">
                All Booked Appointments
            </h1>

            <p class="subtitle">
                View and manage all appointments booked by patients.
            </p>

        </div>


        <?php if ($result->num_rows > 0): ?>


            <!-- =================================================
                 APPOINTMENT TABLE
            ================================================== -->

            <div class="appointment-card">

                <div class="card-header-custom">

                    <h4>
                        Appointment List
                    </h4>

                </div>


                <div class="table-responsive">

                    <table class="table table-striped table-bordered">

                        <thead class="thead-dark">

                            <tr>

                                <th>
                                    Appointment ID
                                </th>

                                <th>
                                    Patient Name
                                </th>

                                <th>
                                    Doctor Name
                                </th>

                                <th>
                                    Specialization
                                </th>

                                <th>
                                    Fees
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Timeslot
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php while ($appointment = $result->fetch_assoc()): ?>


                            <tr>


                                <!-- Appointment ID -->

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['appointment_id'] ?? 'N/A'
                                    );
                                    ?>
                                </td>


                                <!-- Patient Name -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['patient_name'] ?? 'Unknown Patient'
                                    );
                                    ?>

                                </td>


                                <!-- Doctor Name -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['doctor_name'] ?? 'Unknown Doctor'
                                    );
                                    ?>

                                </td>


                                <!-- Specialization -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['spec_category'] ?? 'N/A'
                                    );
                                    ?>

                                </td>


                                <!-- Doctor Fees -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['doctor_fees'] ?? 'N/A'
                                    );
                                    ?>

                                </td>


                                <!-- Appointment Date -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['date'] ?? 'N/A'
                                    );
                                    ?>

                                </td>


                                <!-- Timeslot -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $appointment['timeslot'] ?? 'N/A'
                                    );
                                    ?>

                                </td>


                                <!-- Status -->

                                <td>

                                    <span class="badge-booked">
                                        Booked
                                    </span>

                                </td>


                                <!-- Delete -->

                                <td>

                                    <a
                                        href="delete.php?appointment_id=<?php echo urlencode($appointment['appointment_id']); ?>"
                                        class="btn btn-danger btn-sm delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this appointment?');"
                                    >
                                        Delete
                                    </a>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                        </tbody>

                    </table>

                </div>

            </div>


        <?php else: ?>


            <!-- =================================================
                 NO APPOINTMENTS
            ================================================== -->

            <div class="empty-box">

                <h3>
                    No Appointments Found
                </h3>

                <p class="text-muted">
                    There are currently no appointments in the database.
                </p>

                <a
                    href="../index.php"
                    class="btn btn-primary"
                >
                    Back to Dashboard
                </a>

            </div>


        <?php endif; ?>


    </div>

</div>


<!-- =====================================================
     FOOTER
===================================================== -->

<div class="footer">

    <p>
        &copy; <?php echo date("Y"); ?> MediConnect.
        All Rights Reserved.
    </p>

</div>


</body>

</html>

<?php

// Close database connection
$conn->close();

?>
```

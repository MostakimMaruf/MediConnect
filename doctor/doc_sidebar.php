<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Toggle</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div id="sidebar" class="sidebar">
    <div class="p-4">
        <button class="btn btn-primary btn-block mb-4" style="background-color: white; color: black;">Doctor Dashboard</button>
        <ul class="list-unstyled">
            <li class="mb-2"><a href="../index.php" class="text-decoration-none d-block py-2 px-4 rounded hover-bg-light">Home</a></li>
            <li class="mb-2"><a href="edit_profile.php" class="text-decoration-none d-block py-2 px-4 rounded hover-bg-light">Edit Profile</a></li>
            <li class="mb-2"><a href="../logout.php" class="text-decoration-none d-block py-2 px-4 rounded hover-bg-light">Logout</a></li>
        </ul>
    </div>
</div>

<button id="toggleSidebar" class="btn btn-primary" style="background-color: #2C5F8A;">&#9776;</button>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        var toggleButton = document.getElementById('toggleSidebar');
        sidebar.classList.toggle('sidebar-hidden');
        if (sidebar.classList.contains('sidebar-hidden')) {
            toggleButton.style.left = '10px';
        } else {
            toggleButton.style.left = '260px';
        }
    });
</script>

</body>
</html>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .navbar {
        background-color: #2C5F8A !important;
      }
      .navbar .navbar-brand,
      .navbar .nav-link,
      .navbar .navbar-toggler-icon,
      .navbar .btn-outline-success {
        color: white !important;
      }
      .navbar .navbar-toggler {
        border-color: white !important;
      }
    
      .navbar .btn-outline-success {
        border-color: white !important;
      }
      .navbar .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="/p3">DAS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/p3/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../doctor/doc_dash.php">Doctor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../patient/pat_dash.php">Patient</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/dashboard.php">Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../signup.php">Signup</a>
            </li>
          </ul>
          <form class="d-flex" role="logout">
            <button class="btn btn-outline-success" href="logout.php" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  
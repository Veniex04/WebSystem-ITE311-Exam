<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar with Instagram gradient */
        .navbar {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }

        .navbar-brand,  
        .nav-link,
        .dropdown-item {
            color: white !important;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            color: #ffd1dc !important;
        }

        .dropdown-menu {
            background-color: #cc2366;
            border: none;
        }

        .navbar-toggler {
            background-color: white;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.6rem;
        }

        .content-wrapper {
            margin-top: 30px;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stat-icon {
            font-size: 2rem;
            color: #dc2743;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/') ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon text-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="<?= site_url('dashboard') ?>"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container">
  <div class="content-wrapper">
      <h2 class="fw-bold">Welcome, <?= esc(session('user_name')) ?> 🎉</h2>
      <p class="text-muted">Your role: <strong><?= esc(session('user_role')) ?></strong></p>

      <div class="row mt-4">
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-person-badge-fill"></i></div>
                  <h5>Instructor</h5>
                  <p class="fs-4 fw-bold">152</p>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-clipboard-check-fill"></i></div>
                  <h5>Assignments</h5>
                  <p class="fs-4 fw-bold">34</p>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-bell-fill"></i></div>
                  <h5>Notifications</h5>
                  <p class="fs-4 fw-bold">7</p>
              </div>
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LMS</title>
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
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .bi {
      vertical-align: -0.125em;
      margin-right: 5px;
    }

    /* Content Wrapper */
    .content-wrapper {
      margin-top: 30px;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/') ?>"><i class="bi bi-mortarboard-fill"></i>LMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon text-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= service('uri')->getSegment(1)==''?'active':'' ?>" href="<?= base_url('/') ?>"><i class="bi bi-house-door-fill"></i>Home</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link <?= service('uri')->getSegment(1)=='about'?'active':'' ?>" href="<?= base_url('about') ?>"><i class="bi bi-info-circle-fill"></i>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= service('uri')->getSegment(1)=='contact'?'active':'' ?>" href="<?= base_url('contact') ?>"><i class="bi bi-envelope-fill"></i>Contact</a>
        </li>

        <?php $logged = session()->get('isLoggedIn'); ?>
        <?php if ($logged): ?>
          <!-- Profile Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i>Profile
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?= base_url('settings') ?>"><i class="bi bi-gear-fill"></i> Settings</a></li>
              <li><a class="dropdown-item" href="<?= base_url('help') ?>"><i class="bi bi-question-circle-fill"></i> Help</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link <?= service('uri')->getSegment(1)=='login'?'active':'' ?>" href="<?= base_url('login') ?>"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
          <li class="nav-item"><a class="nav-link <?= service('uri')->getSegment(1)=='register'?'active':'' ?>" href="<?= base_url('register') ?>"><i class="bi bi-person-plus-fill"></i> Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Content Wrapper -->
<div class="container">
  <div class="content-wrapper">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

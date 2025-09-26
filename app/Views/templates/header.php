<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-lg shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/') ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon text-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="<?= site_url('dashboard') ?>"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
        
        <?php if (isset($role) && $role === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/users') ?>"><i class="bi bi-people-fill"></i> Manage Users</a></li>
        <?php elseif (isset($role) && $role === 'teacher'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('teacher/classes') ?>"><i class="bi bi-journal-bookmark-fill"></i> My Classes</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('student/courses') ?>"><i class="bi bi-book-fill"></i> My Courses</a></li>
        <?php endif; ?>

        <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4"></div>
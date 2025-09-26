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

        .role-badge {
            border-radius: 999px;
            padding: 6px 12px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .role-admin { background: #9b1b6f; }
        .role-teacher { background: #cc5a3c; }
        .role-student { background: #3b82f6; }
    </style>
</head>
<body>

<!-- Content -->
<div class="container">
  <div class="content-wrapper">
      <h2 class="fw-bold">Welcome, <?= esc($user_name ?? session('name')) ?> 🎉</h2>
      <p class="text-muted">
          Your role:
          <?php
            // display the incoming $role first; fall back to session('user_role')
            $displayRole = $role ?? session('user_role') ?? 'student';
          ?>
          <span class="role-badge <?= $displayRole === 'admin' ? 'role-admin' : ($displayRole === 'teacher' ? 'role-teacher' : 'role-student') ?>">
              <?= esc($displayRole) ?>
          </span>
      </p>

      <div class="row mt-4">
          <!-- Common cards -->
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-person-badge-fill"></i></div>
                  <h5>Profile</h5>
                  <p class="fs-6 text-muted">View or update profile details</p>
                  <a href="<?= site_url('profile') ?>" class="btn btn-sm btn-outline-primary">Open</a>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-clipboard-check-fill"></i></div>
                  <h5>Notifications</h5>
                  <p class="fs-6 text-muted">See recent notifications</p>
                  <a href="<?= site_url('notifications') ?>" class="btn btn-sm btn-outline-primary">Open</a>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-gear-fill"></i></div>
                  <h5>Settings</h5>
                  <p class="fs-6 text-muted">Account & app settings</p>
                  <a href="<?= site_url('settings') ?>" class="btn btn-sm btn-outline-primary">Open</a>
              </div>
          </div>
      </div>

      <!-- Role specific content -->
      <div class="row mt-4">
        <?php if ($role === 'admin'): ?>
            <!-- ADMIN SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-shield-lock-fill"></i> Admin Panel</h4>
                    <p class="text-muted">Site-wide management tools and user administration.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-people-fill"></i></div>
                                <h5>Users</h5>
                                <p class="fs-4 fw-bold">1,024</p>
                                <a href="<?= site_url('admin/users') ?>" class="btn btn-sm btn-primary">Manage</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-layout-text-window-reverse"></i></div>
                                <h5>Courses</h5>
                                <p class="fs-4 fw-bold">230</p>
                                <a href="<?= site_url('admin/courses') ?>" class="btn btn-sm btn-primary">Manage</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-bar-chart-line-fill"></i></div>
                                <h5>Reports</h5>
                                <p class="fs-6 text-muted">System analytics & logs</p>
                                <a href="<?= site_url('admin/reports') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($role === 'teacher'): ?>
            <!-- TEACHER SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-person-workspace"></i> Teacher Panel</h4>
                    <p class="text-muted">Manage your classes, assignments and student progress.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-journal-check"></i></div>
                                <h5>My Classes</h5>
                                <p class="fs-4 fw-bold">5</p>
                                <a href="<?= site_url('teacher/classes') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-pencil-square"></i></div>
                                <h5>Assignments</h5>
                                <p class="fs-4 fw-bold">12</p>
                                <a href="<?= site_url('teacher/assignments') ?>" class="btn btn-sm btn-primary">Manage</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-people"></i></div>
                                <h5>Students</h5>
                                <p class="fs-6 text-muted">View enrolled students</p>
                                <a href="<?= site_url('teacher/students') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- STUDENT SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-mortarboard-fill"></i> Student Panel</h4>
                    <p class="text-muted">Your courses, assignments and grades.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-book"></i></div>
                                <h5>Courses</h5>
                                <p class="fs-4 fw-bold">6</p>
                                <a href="<?= site_url('student/courses') ?>" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-file-earmark-text"></i></div>
                                <h5>Assignments</h5>
                                <p class="fs-4 fw-bold">8</p>
                                <a href="<?= site_url('student/assignments') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-award-fill"></i></div>
                                <h5>Grades</h5>
                                <p class="fs-6 text-muted">Check your progress</p>
                                <a href="<?= site_url('student/grades') ?>" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
      </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

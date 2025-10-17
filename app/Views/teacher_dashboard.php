<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= esc($title) ?> | ITE311</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        nav a { margin-right: 12px; text-decoration: none; }
        body { font-family: Arial, Helvetica, sans-serif; padding: 24px; }
        .active { font-weight: bold; }
        .dashboard-content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('announcements') ?>">Announcements</a>
        <a href="<?= site_url('teacher/dashboard') ?>" class="active">Teacher Dashboard</a>
        <a href="<?= site_url('auth/logout') ?>">Logout</a>
    </nav>

    <h1>Teacher Dashboard</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="dashboard-content">
        <h2>Welcome, Teacher!</h2>
        <p>You are now logged in as a teacher. This is your dedicated dashboard where you can manage your courses, students, and teaching materials.</p>
        <p>Welcome, <?= esc(session()->get('user_name')) ?>!</p>
    </div>

</body>
</html>

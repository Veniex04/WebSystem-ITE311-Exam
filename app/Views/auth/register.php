<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - LMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); min-height:100vh; display:flex; align-items:center; justify-content:center; font-family:'Segoe UI',Tahoma,Verdana,sans-serif; }
        .card{ border:none; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.2); background:#fff; }
        .btn-gradient{ background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); border:none; color:#fff; font-weight:600; transition:opacity .3s; }
        .btn-gradient:hover{ opacity:.9; }
        a{ text-decoration:none; color:#cc2366; font-weight:500; }
        a:hover{ color:#dc2743; }
    </style>
</head>
<body>
<div class="container" style="max-width:480px;">
    <div class="card p-4">
        <h3 class="mb-2 text-center fw-bold">Create Account</h3>
        <p class="text-muted text-center mb-4">Join us today and get started</p>

        <?php if(isset($validation) && $validation->getErrors()): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('register') ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control" value="<?= old('name') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" value="<?= old('email') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input name="password_confirm" type="password" class="form-control" required>
            </div>

            <!-- optional role select; controller will default to 'student' if not selected -->

            <button class="btn btn-gradient w-100" type="submit">Register</button>

            <div class="text-center mt-3">
                <a href="<?= site_url('login') ?>">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
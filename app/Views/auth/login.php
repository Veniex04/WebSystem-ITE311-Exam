<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - LMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            background: #fff;
            padding: 2rem;
        }
        h3 {
            font-weight: 700;
            color: #333;
        }
        .text-muted {
            color: #6c757d !important;
        }
        .btn-gradient {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            transition: opacity 0.3s;
        }
        .btn-gradient:hover {
            opacity: 0.9;
        }
        .form-label {
            font-weight: 500;
            color: #333;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        a {
            text-decoration: none;
            color: #cc2366;
            font-weight: 500;
        }
        a:hover {
            color: #dc2743;
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="container" style="max-width: 420px;">
    <div class="card">
        <h3 class="mb-2 text-center fw-bold">Welcome Back</h3>
        <p class="text-muted text-center mb-4">Log in to continue</p>

        <?php if (session('error')): ?>
            <div class="alert alert-danger"><?= esc(session('error')) ?></div>
        <?php endif; ?>
        <?php if (session('success')): ?>
            <div class="alert alert-success"><?= esc(session('success')) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('login') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" value="<?= old('email') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>
            <button class="btn btn-gradient w-100" type="submit">Login</button>
            <div class="text-center mt-3">
                <a href="<?= site_url('register') ?>">Don’t have an account? Register</a>
            </div>
        </form>
    </div> 
</div>
</body>
</html>

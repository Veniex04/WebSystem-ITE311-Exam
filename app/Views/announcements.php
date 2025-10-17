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
        .announcement { 
            border: 1px solid #ddd; 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 5px; 
            background-color: #f9f9f9;
        }
        .announcement h3 { 
            color: #333; 
            margin-top: 0; 
        }
        .announcement .date { 
            color: #666; 
            font-size: 0.9em; 
            margin-bottom: 10px;
        }
        .announcement .content { 
            line-height: 1.6; 
        }
        .no-announcements {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('announcements') ?>" class="active">Announcements</a>
        <a href="<?= site_url('auth/logout') ?>">Logout</a>
    </nav>

    <h1>University Announcements</h1>
    
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

    <?php if (empty($announcements)): ?>
        <div class="no-announcements">
            <h3>No announcements available</h3>
            <p>There are currently no announcements to display.</p>
        </div>
    <?php else: ?>
        <?php foreach ($announcements as $announcement): ?>
            <div class="announcement">
                <h3><?= esc($announcement['title']) ?></h3>
                <div class="date">
                    Posted on: <?= date('F j, Y \a\t g:i A', strtotime($announcement['created_at'])) ?>
                </div>
                <div class="content">
                    <?= nl2br(esc($announcement['content'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>

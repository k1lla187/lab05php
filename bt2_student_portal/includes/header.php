<?php
// includes/header.php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/flash.php';
require_once __DIR__ . '/csrf.php';
// session already started
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Student Portal</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body { font-family: Arial, sans-serif; max-width:900px; margin:20px auto; padding:0 10px; }
    header nav a { margin-right: 10px; text-decoration:none; color:#0366d6; }
    .flash { padding:10px; margin:10px 0; border-radius:4px; }
    .flash-success{ background:#e6ffed; border:1px solid #a6f0b8; }
    .flash-error{ background:#ffe6e6; border:1px solid #f0a6a6; }
    .flash-info{ background:#e6f0ff; border:1px solid #a6c9f0; }
    table { width:100%; border-collapse: collapse; margin-top:10px; }
    th,td { padding:8px; border:1px solid #ddd; text-align:left; }
    form.inline { display:inline; }
    nav { margin-bottom:10px; }
  </style>
</head>
<body>
<header>
  <h1>Student Portal</h1>
  <nav>
    <a href="<?= htmlspecialchars(url('dashboard.php')) ?>">Dashboard</a>
    <a href="<?= htmlspecialchars(url('student/profile.php')) ?>">Profile</a>
    <a href="<?= htmlspecialchars(url('student/grades.php')) ?>">Grades</a>
    <a href="<?= htmlspecialchars(url('student/courses.php')) ?>">Courses</a>
    <a href="<?= htmlspecialchars(url('student/registrations.php')) ?>">My Registrations</a>
    <?php if (!empty($_SESSION['auth'])): ?>
      <form method="post" action="<?= htmlspecialchars(url('logout.php')) ?>" style="display:inline" class="inline">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
        <button type="submit">Logout</button>
      </form>
    <?php endif; ?>
  </nav>
</header>

<?php
if ($m = get_flash('success')): ?>
  <div class="flash flash-success"><?= htmlspecialchars($m) ?></div>
<?php endif; ?>
<?php if ($m = get_flash('error')): ?>
  <div class="flash flash-error"><?= htmlspecialchars($m) ?></div>
<?php endif; ?>
<?php if ($m = get_flash('info')): ?>
  <div class="flash flash-info"><?= htmlspecialchars($m) ?></div>
<?php endif; ?>

<main>
<?php
// includes/header.php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/flash.php';
require_once __DIR__ . '/csrf.php';

$user = current_user();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Shop Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CDN for simple styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Shop Demo</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <?php if (is_logged_in()): ?>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
          <?php if (!empty($user['role']) && $user['role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link text-danger" href="#">Admin Panel</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <?php if (is_logged_in()): ?>
          <li class="nav-item">
            <span class="navbar-text me-3">Hi, <?php echo htmlspecialchars($user['username'] ?? ''); ?></span>
          </li>
          <li class="nav-item">
            <form method="post" action="logout.php" class="d-inline">
              <?php echo csrf_field(); ?>
              <button class="btn btn-outline-secondary btn-sm" type="submit">Logout</button>
            </form>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-3">
  <?php render_flash(); ?>
</div>
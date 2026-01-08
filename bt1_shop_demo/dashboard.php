<?php
// dashboard.php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/flash.php';
require_login();

require_once __DIR__ . '/includes/header.php';
$user = current_user();
?>
<div class="container mt-5">
  <h2>Dashboard</h2>
  <p>Xin chào, <strong><?php echo htmlspecialchars($user['username']); ?></strong>!</p>
  <p>Role: <?php echo htmlspecialchars($user['role']); ?></p>
  <p>
    <a href="products.php" class="btn btn-success">Xem sản phẩm</a>
    <a href="cart.php" class="btn btn-secondary">Xem giỏ hàng</a>
  </p>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
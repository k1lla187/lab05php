<?php
// cart.php - view and handle cart actions (POST)
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/cart.php';
require_once __DIR__ . '/includes/products.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf'] ?? null)) {
        http_response_code(400);
        echo 'Bad Request';
        exit;
    }

    // Remove single item: submitted as button with name="remove" value="{product_id}"
    if (!empty($_POST['remove'])) {
        $product_id = (int)$_POST['remove'];
        cart_remove($product_id);
        set_flash('info', 'Đã xóa sản phẩm khỏi giỏ.');
        header('Location: cart.php');
        exit;
    }

    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $product_id = (int)($_POST['product_id'] ?? 0);
        $qty = max(1, (int)($_POST['qty'] ?? 1));
        cart_add($product_id, $qty);
        set_flash('success', 'Đã thêm sản phẩm vào giỏ.');
        header('Location: cart.php');
        exit;
    } elseif ($action === 'update') {
        // Only update quantities that are present in POST.
        // This avoids accidentally deleting items if browser did not send some inputs.
        $qtys = $_POST['qty'] ?? [];
        $currentCart = $_SESSION['cart'] ?? [];
        foreach ($currentCart as $pid => $existingQty) {
            if (isset($qtys[$pid])) {
                $newQty = (int)$qtys[$pid];
                cart_update((int)$pid, $newQty);
            }
            // if qty not set in POST, keep existing quantity
        }
        set_flash('success', 'Cập nhật giỏ hàng thành công.');
        header('Location: cart.php');
        exit;
    } elseif ($action === 'clear') {
        cart_clear();
        set_flash('info', 'Đã xóa toàn bộ giỏ hàng.');
        header('Location: cart.php');
        exit;
    } else {
        http_response_code(400);
        echo 'Bad Request';
        exit;
    }
}

// GET: show cart
$items = cart_items(); // returns array of items with product data + qty
$total = cart_total();

require_once __DIR__ . '/includes/header.php';
?>
<div class="container mt-5">
  <h2>Your Cart</h2>
  <?php if (empty($items)): ?>
    <div class="alert alert-secondary">Giỏ hàng trống. <a href="products.php">Mua ngay</a></div>
  <?php else: ?>
    <form method="post" action="cart.php">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="action" value="update">
      <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th style="width:120px">Qty</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><?php echo htmlspecialchars($it['name']); ?></td>
              <td><?php echo number_format($it['price'], 0, ',', '.'); ?></td>
              <td>
                <input type="number" name="qty[<?php echo (int)$it['id']; ?>]" value="<?php echo (int)$it['qty']; ?>" min="0" class="form-control" required>
                <small class="text-muted">Set to 0 to remove</small>
              </td>
              <td><?php echo number_format($it['price'] * $it['qty'], 0, ',', '.'); ?></td>
              <td>
                <!-- Remove button as part of the same form -->
                <button type="submit" name="remove" value="<?php echo (int)$it['id']; ?>" class="btn btn-sm btn-danger">Remove</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <button class="btn btn-primary">Update Cart</button>
          <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
        <div>
          <strong>Total: <?php echo number_format($total, 0, ',', '.'); ?> VND</strong>
          <button type="submit" name="action" value="clear" class="btn btn-outline-danger btn-sm">Clear Cart</button>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
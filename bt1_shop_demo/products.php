<?php
// products.php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/includes/products.php';
require_login();

$products = get_products();

require_once __DIR__ . '/includes/header.php';
?>
<div class="container mt-5">
  <h2>Products</h2>
  <div class="row">
    <?php foreach ($products as $p): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($p['name']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($p['description']); ?></p>
            <p class="card-text"><strong>Price:</strong> <?php echo number_format($p['price'], 0, ',', '.'); ?> VND</p>
            <form method="post" action="cart.php">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="action" value="add">
              <input type="hidden" name="product_id" value="<?php echo (int)$p['id']; ?>">
              <div class="input-group mb-2">
                <input type="number" name="qty" value="1" min="1" class="form-control" style="max-width:100px">
                <button class="btn btn-primary">Add to Cart</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
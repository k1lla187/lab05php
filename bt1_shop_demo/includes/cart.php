<?php
// includes/cart.php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/products.php';

function cart_add(int $id, int $qty = 1): void {
    if ($qty < 1) $qty = 1;
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
}

function cart_update(int $id, int $qty): void {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id] = $qty;
    }
}

function cart_remove(int $id): void {
    if (!isset($_SESSION['cart'])) return;
    unset($_SESSION['cart'][$id]);
}

function cart_clear(): void {
    $_SESSION['cart'] = [];
}

function cart_items(): array {
    $out = [];
    $cart = $_SESSION['cart'] ?? [];
    foreach ($cart as $id => $qty) {
        $p = find_product((int)$id);
        if ($p) {
            $p['qty'] = $qty;
            $out[] = $p;
        }
    }
    return $out;
}

function cart_total(): int {
    $total = 0;
    foreach (cart_items() as $it) {
        $total += ($it['price'] * $it['qty']);
    }
    return $total;
}
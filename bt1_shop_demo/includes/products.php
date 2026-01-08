<?php
// includes/products.php
declare(strict_types=1);
function get_products(): array {
    return [
        ['id' => 1, 'name' => 'Laptop A', 'description' => 'Laptop cấu hình tốt', 'price' => 15000000],
        ['id' => 2, 'name' => 'Phone B', 'description' => 'Điện thoại màn hình lớn', 'price' => 7000000],
        ['id' => 3, 'name' => 'Headphones C', 'description' => 'Tai nghe bluetooth', 'price' => 1200000],
        ['id' => 4, 'name' => 'Keyboard D', 'description' => 'Bàn phím cơ', 'price' => 900000],
        ['id' => 5, 'name' => 'Mouse E', 'description' => 'Chuột quang', 'price' => 250000],
    ];
}

function find_product(int $id): ?array {
    foreach (get_products() as $p) {
        if ((int)$p['id'] === $id) return $p;
    }
    return null;
}
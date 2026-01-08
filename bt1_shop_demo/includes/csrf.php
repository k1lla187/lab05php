<?php
// includes/csrf.php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_verify(?string $token): bool {
    return !empty($token) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

// helper to print hidden field
function csrf_field(): string {
    $t = csrf_token();
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars($t) . '">';
}
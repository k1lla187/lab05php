<?php
// includes/flash.php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

function set_flash(string $key, string $message): void {
    $_SESSION['flash'][$key] = $message;
}

function get_flash(string $key): ?string {
    if (empty($_SESSION['flash'][$key])) return null;
    $msg = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $msg;
}

// convenience: render all known types
function render_flash(): void {
    $types = ['success' => 'success', 'error' => 'danger', 'info' => 'info'];
    foreach ($types as $k => $cls) {
        $m = get_flash($k);
        if ($m !== null) {
            echo "<div class=\"alert alert-{$cls}\">" . htmlspecialchars($m) . "</div>";
        }
    }
}
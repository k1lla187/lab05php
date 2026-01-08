<?php
// includes/flash.php
declare(strict_types=1);
// session already started in config.php
function set_flash(string $key, string $message): void {
    if (!isset($_SESSION['flash'])) $_SESSION['flash'] = [];
    $_SESSION['flash'][$key] = $message;
}
function get_flash(string $key): ?string {
    if (empty($_SESSION['flash'][$key])) return null;
    $msg = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $msg;
}
?>
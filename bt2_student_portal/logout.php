<?php
// logout.php (POST + CSRF)
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf'] ?? null)) {
    http_response_code(400);
    exit('Bad Request');
}

// destroy session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

session_start(); // start new session to set flash and redirect
set_flash('info', 'Bạn đã đăng xuất.');
header('Location: ' . url('login.php'));
exit;
?>
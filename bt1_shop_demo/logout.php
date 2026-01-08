<?php
// logout.php - POST + CSRF
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/includes/logger.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf'] ?? null)) {
    http_response_code(400);
    echo 'Bad Request';
    exit;
}

$username = current_user()['username'] ?? null;

// destroy session and remove cookie
session_unset();
session_destroy();
setcookie('remember_username', '', time() - 3600, '/');
unset($_COOKIE['remember_username']);
session_start(); // start a fresh session to set flash
set_flash('info', 'Bạn đã đăng xuất.');
if ($username) log_event("LOGOUT: {$username}");
header('Location: login.php');
exit;
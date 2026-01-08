<?php
// includes/auth.php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

function require_login(): void {
    if (empty($_SESSION['auth'])) {
        header('Location: ' . url('login.php'));
        exit;
    }
}

function current_student(): array {
    return $_SESSION['student'] ?? [];
}

function login_student(array $student): void {
    // store only necessary fields
    $_SESSION['auth'] = true;
    $_SESSION['student'] = [
        'student_code' => $student['student_code'] ?? '',
        'full_name' => $student['full_name'] ?? '',
        'class_name' => $student['class_name'] ?? '',
        'email' => $student['email'] ?? ''
    ];
}
?>
<?php
// includes/config.php
declare(strict_types=1);

// Start session once for the whole app
if (session_status() === PHP_SESSION_NONE) session_start();

/*
 Optional manual override:
 // define('BASE_PATH', '/Labs/lab05/bt2_student_portal/');
 If you prefer manual setting, uncomment and change the line above.
*/

// Auto-detect BASE_PATH (URL path to project) from DOCUMENT_ROOT and project dir.
// Works on typical Apache/XAMPP setups where DOCUMENT_ROOT points to C:\xampp\htdocs
if (!defined('BASE_PATH')) {
    $projectDir = realpath(__DIR__ . '/..'); // filesystem path to project root
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
    if ($projectDir !== false && $docRoot !== false && strpos($projectDir, $docRoot) === 0) {
        $rel = str_replace('\\', '/', substr($projectDir, strlen($docRoot)));
        $rel = '/' . trim($rel, '/');
        $rel = $rel === '' ? '/' : $rel . '/';
        define('BASE_PATH', $rel);
    } else {
        // fallback to root
        define('BASE_PATH', '/');
    }
}

function url(string $path = ''): string {
    $base = rtrim(BASE_PATH, '/');
    if ($path === '' || $path === '/') return $base === '' ? '/' : $base . '/';
    return $base . '/' . ltrim($path, '/');
}
?>
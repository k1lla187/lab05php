<?php
// dashboard.php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_login();
$student = current_student();
require_once __DIR__ . '/includes/header.php';
?>
<h2>Welcome, <?= htmlspecialchars($student['full_name'] ?? '') ?></h2>
<p>Use the navigation to access your profile, grades and course registration.</p>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
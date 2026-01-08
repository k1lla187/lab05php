<?php
// login.php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/flash.php';

if (!empty($_SESSION['auth'])) {
    header('Location: ' . url('student/profile.php'));
    exit;
}

$error = '';
$students = read_json('students.json', []);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = trim($_POST['student_code'] ?? '');
    $pass = (string)($_POST['password'] ?? '');
    if ($code === '' || $pass === '') {
        $error = 'Vui lòng nhập đầy đủ mã SV và mật khẩu.';
    } else {
        $found = null;
        foreach ($students as $s) {
            if (($s['student_code'] ?? '') === $code) { $found = $s; break; }
        }
        if ($found && password_verify($pass, $found['password_hash'] ?? '')) {
            $_SESSION['auth'] = true;
            $_SESSION['student'] = [
                'student_code' => $found['student_code'] ?? '',
                'full_name' => $found['full_name'] ?? '',
                'class_name' => $found['class_name'] ?? '',
                'email' => $found['email'] ?? ''
            ];
            set_flash('success', 'Đăng nhập thành công.');
            header('Location: ' . url('student/profile.php'));
            exit;
        } else {
            $error = 'Sai mã SV hoặc mật khẩu.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<h2>Login</h2>
<?php if ($error): ?>
  <div class="flash flash-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="post" action="<?= htmlspecialchars(url('login.php')) ?>">
  <div>
    <label>Mã SV: <input type="text" name="student_code" value="<?= htmlspecialchars($_POST['student_code'] ?? '') ?>"></label>
  </div>
  <div>
    <label>Mật khẩu: <input type="password" name="password"></label>
  </div>
  <div style="margin-top:10px;">
    <button type="submit">Login</button>
  </div>
</form>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
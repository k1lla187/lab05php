<?php
// login.php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/includes/users.php';
require_once __DIR__ . '/includes/logger.php';

if (session_status() === PHP_SESSION_NONE) session_start();

$users = get_users(); // returns array

$error = '';
$usernamePrefill = $_COOKIE['remember_username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string)($_POST['password'] ?? '');
    $remember = !empty($_POST['remember']);

    if ($username === '' || $password === '') {
        $error = 'Vui lòng nhập đầy đủ username và password.';
    } else {
        if (!empty($users[$username]) && password_verify($password, $users[$username]['hash'])) {
            // login success
            $_SESSION['auth'] = true;
            $_SESSION['user'] = [
                'username' => $username,
                'role' => $users[$username]['role']
            ];
            if ($remember) {
                setcookie('remember_username', $username, time() + 7*24*60*60, '/');
            } else {
                setcookie('remember_username', '', time() - 3600, '/');
            }
            log_event("LOGIN: {$username}");
            set_flash('success', 'Đăng nhập thành công.');
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Sai tài khoản hoặc mật khẩu.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<div class="container mt-5">
  <h2>Login - Shop Demo</h2>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <form method="post" action="login.php" class="mt-3">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control"
             value="<?php echo htmlspecialchars($usernamePrefill); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="remember" id="remember" class="form-check-input">
      <label for="remember" class="form-check-label">Remember me (7 days)</label>
    </div>
    <button class="btn btn-primary">Login</button>
  </form>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
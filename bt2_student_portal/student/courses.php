<?php
// student/courses.php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_once __DIR__ . '/../includes/csrf.php';
require_login();
$student = current_student();
$code = $student['student_code'] ?? '';

$courses = read_json('courses.json', []);
$enrollments = read_json('enrollments.json', []);

$enrolled = [];
foreach ($enrollments as $e) {
    if (($e['student_code'] ?? '') === $code) {
        $enrolled[$e['course_code']] = true;
    }
}
require_once __DIR__ . '/../includes/header.php';
?>
<h2>Courses</h2>
<?php if (empty($courses)): ?>
  <p>Chưa có học phần nào.</p>
<?php else: ?>
  <table>
    <thead><tr><th>Code</th><th>Name</th><th>Credits</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach ($courses as $c): ?>
        <tr>
          <td><?= htmlspecialchars($c['course_code'] ?? '') ?></td>
          <td><?= htmlspecialchars($c['course_name'] ?? '') ?></td>
          <td><?= htmlspecialchars((string)($c['credits'] ?? '')) ?></td>
          <td>
            <?php if (isset($enrolled[$c['course_code']])): ?>
              <em>Đã đăng ký</em>
            <?php else: ?>
              <form method="post" action="<?= htmlspecialchars(url('student/register.php')) ?>">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
                <input type="hidden" name="course_code" value="<?= htmlspecialchars($c['course_code'] ?? '') ?>">
                <button type="submit">Đăng ký</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
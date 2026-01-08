<?php
// student/registrations.php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_once __DIR__ . '/../includes/csrf.php';
require_login();
$student = current_student();
$code = $student['student_code'] ?? '';

$courses = read_json('courses.json', []);
$courseMap = [];
foreach ($courses as $c) $courseMap[$c['course_code']] = $c;

$enrollments = read_json('enrollments.json', []);
$grades = read_json('grades.json', []);

$myEnrolls = array_values(array_filter($enrollments, fn($e) => ($e['student_code'] ?? '') === $code));
require_once __DIR__ . '/../includes/header.php';
?>
<h2>My Registrations</h2>
<?php if (empty($myEnrolls)): ?>
  <p>Bạn chưa đăng ký học phần nào.</p>
<?php else: ?>
  <table>
    <thead><tr><th>Course</th><th>Registered at</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach ($myEnrolls as $e):
        $cc = $e['course_code'] ?? '';
        $hasGrade = false;
        foreach ($grades as $g) {
            if (($g['student_code'] ?? '') === $code && ($g['course_code'] ?? '') === $cc) { $hasGrade = true; break; }
        }
      ?>
        <tr>
          <td><?= htmlspecialchars($courseMap[$cc]['course_name'] ?? $cc) ?></td>
          <td><?= htmlspecialchars($e['created_at'] ?? '') ?></td>
          <td>
            <?php if ($hasGrade): ?>
              <em>Không thể hủy (đã có điểm)</em>
            <?php else: ?>
              <form method="post" action="<?= htmlspecialchars(url('student/unregister.php')) ?>" class="inline">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
                <input type="hidden" name="course_code" value="<?= htmlspecialchars($cc) ?>">
                <button type="submit">Hủy đăng ký</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
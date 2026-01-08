<?php
// student/grades.php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_login();
$student = current_student();
$code = $student['student_code'] ?? '';
$courses = read_json('courses.json', []);
$grades = read_json('grades.json', []);

$courseMap = [];
foreach ($courses as $c) $courseMap[$c['course_code']] = $c;

$myGrades = array_values(array_filter($grades, fn($g) => ($g['student_code'] ?? '') === $code));
require_once __DIR__ . '/../includes/header.php';
?>
<h2>Grades</h2>
<?php if (empty($myGrades)): ?>
  <p>Bạn chưa có điểm nào.</p>
<?php else: ?>
  <table>
    <thead><tr><th>Course</th><th>Midterm</th><th>Final</th><th>Total</th></tr></thead>
    <tbody>
      <?php foreach ($myGrades as $g):
        $c = $courseMap[$g['course_code']] ?? null;
      ?>
        <tr>
          <td><?= htmlspecialchars($c['course_name'] ?? ($g['course_code'] ?? '')) ?></td>
          <td><?= htmlspecialchars((string)($g['midterm'] ?? '')) ?></td>
          <td><?= htmlspecialchars((string)($g['final'] ?? '')) ?></td>
          <td><?= htmlspecialchars((string)($g['total'] ?? '')) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
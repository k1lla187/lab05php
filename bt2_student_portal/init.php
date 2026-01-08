<?php
// init.php
// Run once to create sample data files (you can run: php init.php)
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$students = [
    [
        "student_code" => "SV001",
        "full_name" => "Nguyễn Văn A",
        "class_name" => "DCCNTT13",
        "email" => "a@example.com",
        "password_hash" => password_hash("123456", PASSWORD_DEFAULT)
    ],
    [
        "student_code" => "SV002",
        "full_name" => "Trần Thị B",
        "class_name" => "DCCNTT13",
        "email" => "b@example.com",
        "password_hash" => password_hash("abcdef", PASSWORD_DEFAULT)
    ]
];

$courses = [
    ["course_code" => "IT101", "course_name" => "Lập trình PHP", "credits" => 3],
    ["course_code" => "IT102", "course_name" => "Cơ sở dữ liệu", "credits" => 3],
    ["course_code" => "IT103", "course_name" => "Mạng máy tính", "credits" => 2]
];

$enrollments = [
    // sample: uncomment to give initial enrollment
    // ['student_code'=>'SV001','course_code'=>'IT101','created_at'=>date('Y-m-d H:i:s')]
];

$grades = [
    [
        "student_code" => "SV001",
        "course_code" => "IT101",
        "midterm" => 7.0,
        "final" => 8.0,
        "total" => 7.5
    ]
];

write_json('students.json', $students);
write_json('courses.json', $courses);
write_json('enrollments.json', $enrollments);
write_json('grades.json', $grades);

echo "Data initialized in /data/*.json\n";
?>
<?php
// includes/users.php
declare(strict_types=1);
// returns users array: username => ['hash'=>..., 'role'=>...]
function get_users(): array {
    // Using password_hash() at runtime for convenience (not recommended for production)
    return [
        'admin' => [
            'hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ],
        'student' => [
            'hash' => password_hash('student123', PASSWORD_DEFAULT),
            'role' => 'user'
        ]
    ];
}
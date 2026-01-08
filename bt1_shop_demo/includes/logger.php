<?php
// includes/logger.php
declare(strict_types=1);
function log_path(): string {
    return __DIR__ . '/../data/log.txt';
}

function log_event(string $message): void {
    $line = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
    $path = log_path();
    $dir = dirname($path);
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    file_put_contents($path, $line, FILE_APPEND | LOCK_EX);
}
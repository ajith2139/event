<?php
$password = $_GET['password'] ?? '';

if ($password !== 'admin') {
    http_response_code(403);
    echo 'Unauthorized';
    exit;
}

$filename = __DIR__ . '/participants.csv';
if (!file_exists($filename)) {
    http_response_code(404);
    echo 'File not found';
    exit;
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="participants.csv"');
readfile($filename);

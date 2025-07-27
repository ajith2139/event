<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

$name      = trim($_POST['name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$regNumber = trim($_POST['regNumber'] ?? '');

if (empty($name) || empty($email) || empty($regNumber)) {
    echo json_encode(['success' => false, 'error' => 'All fields are required']);
    exit;
}

$filename = __DIR__ . '/participants.csv';
if (!is_writable(dirname($filename))) {
    echo json_encode(['success' => false, 'error' => 'Cannot write to storage']);
    exit;
}

$file = fopen($filename, 'a');
if (!$file) {
    echo json_encode(['success' => false, 'error' => 'Failed to open file']);
    exit;
}

if (fputcsv($file, [$name, $email, $regNumber]) === false) {
    fclose($file);
    echo json_encode(['success' => false, 'error' => 'Failed to write data']);
    exit;
}

fclose($file);
echo json_encode(['success' => true]);


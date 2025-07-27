<?php
header('Content-Type: application/json');

$filename = __DIR__ . '/participants.csv';
$data = [];

if (file_exists($filename) && is_readable($filename)) {
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            // Skip empty lines
            if (count($row) < 3) {
                continue;
            }
            $data[] = [
                'name'      => $row[0],
                'email'     => $row[1],
                'regNumber' => $row[2]
            ];
        }
        fclose($handle);
    }
}

echo json_encode($data);

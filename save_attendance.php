<?php
header("Access-Control-Allow-Origin: *"); // Allow CORS for testing, restrict in production

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->name) && !empty(trim($data->name))) {
        // For simplicity, appending to a file 'attendance.txt'
        $file = fopen("attendance.txt", "a");
        fwrite($file, trim($data->name) . "\n");
        fclose($file);

        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false]);
?>

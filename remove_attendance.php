<?php
header("Access-Control-Allow-Origin: *"); // Allow CORS for testing, restrict in production

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->index)) {
        $index = intval($data->index); // Convert index to integer

        // Read all names from file 'attendance.txt' into an array
        $file = file("attendance.txt");
        $attendance = array_map('trim', $file); // Trim whitespace from each line

        // Remove the name at the specified index
        if (isset($attendance[$index])) {
            unset($attendance[$index]);
        }

        // Write remaining names back to the file
        file_put_contents("attendance.txt", implode("\n", $attendance));

        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false]);
?>

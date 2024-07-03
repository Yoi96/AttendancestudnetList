<?php
header("Access-Control-Allow-Origin: *"); // Allow CORS for testing, restrict in production

// Read all names from file 'attendance.txt' into an array
$file = file("attendance.txt");
$attendance = array_map('trim', $file); // Trim whitespace from each line

echo json_encode(['attendance' => $attendance]);
?>

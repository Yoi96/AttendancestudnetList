<?php
// Load messages (you can replace this with a database fetch operation)
$messages = [];

$file = fopen("messages.txt", "r");
if ($file) {
    while (($line = fgets($file)) !== false) {
        $messages[] = trim($line);
    }
    fclose($file);
}

// Return messages as JSON
echo json_encode(['messages' => $messages]);
?>

<?php
// Check if the message is sent via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the JSON input
    $data = json_decode(file_get_contents("php://input"));

    // Validate message
    if (isset($data->message) && !empty(trim($data->message))) {
        // Store message (you can replace this with a database insert operation)
        $message = trim($data->message);
        // For demonstration, storing in a file messages.txt
        $file = fopen("messages.txt", "a");
        fwrite($file, $message . "\n");
        fclose($file);

        // Return success response
        echo json_encode(['success' => true, 'message' => $message]);
        exit;
    }
}

// If invalid request or message is empty, return error
echo json_encode(['success' => false]);
?>

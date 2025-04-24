<?php
// Include database connection
require_once '../config/db.php';

$cm = new class_model();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['request_id'])) {
        $requestId = $input['request_id'];

   
        $exists = $cm->doesRequestIdExist($requestId);

        echo json_encode(['exists' => $exists]);
    } else {
        echo json_encode(['error' => 'request_id is required']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
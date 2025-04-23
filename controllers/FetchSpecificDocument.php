<?php

require_once '../config/db.php';

$cm = new class_model();

if (isset($_GET['id'])) {
    
    $document_id = $_GET['id'];

    // Fetch the document data from the database
    $document = $cm->getDocumentById($document_id);

    if ($document) {

        header('Content-Type: application/json');
        echo json_encode($document);
    } else {
        // Return an error response if the document is not found
        echo json_encode(['error' => 'Document not found']);
    }
}

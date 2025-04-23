<?php
require_once '../config/db.php'; // DB connection


$cm = new class_model();

$documents = $cm->getAllRequests(); // Fetch documents for the student

echo json_encode($documents);
?>

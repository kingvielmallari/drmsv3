<?php
require_once '../config/db.php'; // DB connection


$cm = new class_model();

$documents = $cm->getAllRequests();

echo json_encode($documents);
?>

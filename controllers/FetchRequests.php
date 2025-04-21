<?php
require_once '../config/db.php'; // DB connection

header('Content-Type: application/json');

$cm = new class_model();
$requests = $cm->fetchAllRequests();

echo json_encode($requests);
?>

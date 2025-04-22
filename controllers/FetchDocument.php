<?php
require_once '../config/db.php'; // DB connection


$cm = new class_model();

$documents = $cm->getDocuments();

echo json_encode($documents);
?>

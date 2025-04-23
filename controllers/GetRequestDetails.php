<?php
require_once '../config/db.php'; // DB connection


$cm = new class_model();


$id = $_POST['id']; // Get the ID from the POST request

$documents = $cm->getrequestdetails($id); // Fetch documents for the student

echo json_encode($documents);
?>

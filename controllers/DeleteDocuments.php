<?php
require_once '../config/db.php'; // Include your DB connection

$cm = new class_model(); 

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Call the deleteStudent function
    $deleted = $cm->deleteDocument($id);

    }
?>

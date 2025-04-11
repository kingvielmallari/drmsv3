<?php
require_once '../config/db.php'; // Include your DB connection

$cm = new class_model(); 

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Call the deleteStudent function
    $deleted = $cm->deleteStudent($student_id);

    }
    else {
        // Handle the case where student_id is not set
        echo json_encode(["message" => "Student ID not provided"]);
        exit();
    }
    
?>

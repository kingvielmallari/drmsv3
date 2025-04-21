<?php
require_once '../config/db.php'; // Include your DB connection

$cm = new class_model(); 

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Call the deleteStudent function
    $deleted = $cm->deleteStudent($student_id);

    if ($deleted) {
        echo json_encode(["success" => true, "message" => "Student deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete student"]);
    }
} else {
    // Handle the case where student_id is not set
    echo json_encode(["success" => false, "message" => "Student ID not provided"]);
}
exit();
?>

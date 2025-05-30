<?php
require_once '../config/db.php'; // DB connection file

header('Content-Type: application/json');

$cm = new class_model();

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $student = $cm->getSpecificStudent($student_id);

    if ($student) {
        echo json_encode($student);
    } else {
        echo json_encode(["error" => "Student not found"]);
    }
} else {
    echo json_encode(["error" => "No student ID provided"]);
}
?>

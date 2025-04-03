<?php

require_once '../config/db.php';

$cm = new class_model(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST['studentId']);
    $first_name = trim($_POST['firstName']);
    $last_name = trim($_POST['lastName']);
    $middle_name = trim($_POST['middleName']);
    $email = trim($_POST['studentEmail']);
    $contact = trim($_POST['studentContact']);

    $result = $cm->addStudent($student_id, $last_name, $first_name, $middle_name, $email, $contact);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Student added successfully"]);
        exit(); 
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add student"]);
        exit();
    }
}
<?php
require_once '../config/db.php';


$cm = new class_model(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST['student_id']);
    $password = trim($_POST['password']);

    $user = $cm->loginUsers($student_id, $password);

    if ($user) {
        session_start(); // Start the session   
        $_SESSION['sessionuser'] = $user; // Store user data in session
        echo json_encode(["success" => true, "message" => "Login successful"]);
        exit(); 
    } else {
        echo json_encode(["success" => false, "message" => "Invalid student ID or password"]);
        exit();
    }
}
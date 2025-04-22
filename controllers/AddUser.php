<?php
require_once '../config/db.php'; // Include your class

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $studentId = $_POST['student_id'];

    // Create user
    if ($cm->updateUserPassword($studentId, $confirm_password)) {
        unset($_SESSION['token']);

        echo "Account created successfully!";
    } else {
        echo "Error adding user.";
    }
}
?>

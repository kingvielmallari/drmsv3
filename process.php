<?php
require_once 'config/db.php'; // Include your class

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $student_id = trim($_POST['student_id']);
    $name = trim($_POST['name']);
    $email =trim($_POST['email']);
    $password = trim($_POST['password']);



    }   
    // Validate email
    if (strpos($email, '@ptc.edu.ph') === false) {
        echo "Invalid email address. Email must include '@ptc.edu.ph'.";
    } else {
        // Create user
        if ($cm->createUser($student_id, $name, $email, $password)) {
            echo "User added successfully!";
        } else {
            echo "Error adding user.";
        }
    }
?>

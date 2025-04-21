<?php
require_once '../config/db.php'; // Include your class

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $password = trim($_POST['password']);

    // Create user
    if ($cm->updateUserPassword($password)) {
        echo "Account created successfully!";
    } else {
        echo "Error adding user.";
    }
}
?>

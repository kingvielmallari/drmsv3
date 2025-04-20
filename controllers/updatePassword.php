<?php
require_once '../config/db.php'; // Include your class

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the token from the URL query parameter
    if (isset($_POST['token'])) {
        $token = trim($_POST['token']);
    } else {
        echo "Token is missing!";
        exit;
    }

    $student_id = trim($_POST['student_id']);
    $confirm_password = trim($_POST['confirm_password']);

    // Update password
    if ($cm->updateUserPassword($student_id, $confirm_password)) {
        // Delete token after password update
        if ($cm->deleteToken($token)) {
            echo "Password updated successfully!";
        } else {
            echo "Error deleting token.";
        }
    } else {
        echo "Error updating password.";
    }
}


?>

<?php
require_once '../config/db.php'; // Include your class

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $student_id = trim($_POST['student_id']);
    $password = trim($_POST['password']);

    // Check if student_id exists in tbl_student
    if (!$cm->isStudentIdExists($student_id)) {
        echo "Sorry, you are not a student of PTC.";
    } else {
        // Check if user already exists
        if ($cm->isUserExistsByStudentId($student_id)) {
            echo "Account already exists.";
        } else {
            // Create user
            if ($cm->updateUserPassword($student_id, $password)) {
                echo "Account created successfully!, please login to your account.";
            } else {
                echo "Error adding user.";
            }
        }
    }
}
?>

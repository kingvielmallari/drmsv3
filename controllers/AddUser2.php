
<?php
require_once '../config/db.php'; // Include your class

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $last_name = trim($_POST['last_name']);
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $year_graduated = $_POST['year_graduated'];
    $last_year_attended = $_POST['last_year_attended'];
    $status = $_POST['status'];
    $password = $_POST['confirm_password'];

    // Create user
        if ($cm->createUser($last_name, $first_name, $middle_name, $year_graduated, $last_year_attended, $status, $password)) {
            echo "Account created successfully!";
    } else {
        echo "Error adding user.";
    }
}
?>


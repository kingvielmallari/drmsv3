<?php
session_start();
require_once '../config/db.php';

$cm = new class_model(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $person = $cm->loginUsers($email, $password);


    if ($person) {
        $_SESSION['email'] = $person; // Store user data in session
        echo json_encode(["success" => true, "message" => "Login successful"]);
        exit(); 
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password"]);
        exit();
    }
}
?>


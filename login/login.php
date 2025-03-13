<?php
session_start();
require_once '../db.php';

$cm = new class_model(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = $cm->loginUsers($email, $password);

    if ($user) {
        $_SESSION['user'] = $user; // Store user data in session
        echo json_encode(["success" => true, "message" => "Login successful"]);
        exit(); 
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password"]);
        exit();
    }
}
?>


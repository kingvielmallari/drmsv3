<?php
require_once '../config/db.php'; // your DB handler
require '../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // You can validate the email format if needed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email.";
        exit;
    }

    $db = new class_model();

    // Search for student by email
    $user = $db->findByEmail($email);

    if ($user) {
        if ($user['password'] !== null) {
            echo "Account already exists.";
            exit;
        }

        if (strpos($email, "@paterostechnologicalcollege.edu.ph") !== false) {
            $otp = rand(1000, 9999); // Generate 4-digit OTP

            // Save OTP and secure token to session
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            $_SESSION['token'] = bin2hex(random_bytes(32)); // Generate a secure random token

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mallariking0@gmail.com'; // Gmail email
                $mail->Password = 'jxdp anpe abru eslr';     // Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('mallariking0@gmail.com', 'PTC DRMS');
                $mail->addAddress($email);
                $mail->Subject = 'Your PTC DRMS OTP';
                $mail->Body = "Hello,\n\nYour OTP is: $otp\n\nPlease enter it to verify your email address.\n\n- PTC DRMS";

                $mail->send();
                echo "OTP sent!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "This email is not registered as a student.";
        }
    } else {
        echo "This email is not registered as a student.";
    }
}

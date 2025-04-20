<?php
require_once '../config/db.php'; // your class_model
require '../vendor/autoload.php'; // PHPMailer

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    $db = new class_model();

    $db->cleanupExpiredTokens();

    $userCheck = $db->findByEmail($email);
    if ($userCheck && is_null($userCheck['password'])) {
        echo "You have not set your password yet. Please create an account first.";
        exit;
    }

    $existingToken = $db->hasValidToken($email);

    if ($existingToken) {
        echo "A reset link has already been sent. Please check your email.";
        exit;
    }

    $user = $db->findByEmail($email);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $created_at = date("Y-m-d H:i:s"); // current time when the request is made
        $expires = date("Y-m-d H:i:s", strtotime("+5 minutes")); // calculate 5 minutes from now

        $db->saveResetToken($email, $token, $created_at, $expires);


        // $resetLink = "https://ptc.ninja/drmsv3/reset-password.php?token=$token";

        // Dynamically set base URL based on environment
        if ($_SERVER['HTTP_HOST'] === 'localhost') {
            $baseUrl = "http://localhost/drmsv3/";
        } else {
            $baseUrl = "https://ptc.ninja/drmsv3/";
        }

        $resetLink = $baseUrl . "reset-password.php?token=$token";

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mallariking0@gmail.com';
            $mail->Password = 'jxdp anpe abru eslr';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mallariking0@gmail.com', 'PTC DRMS');
            $mail->addAddress($email);
            $mail->Subject = 'Reset Your PTC DRMS Password';
            $mail->Body = "Hello " . $user['last_name'] . "! Please click <a href=\"$resetLink\">here</a> to reset your password. (This link will expire in 5 minutes)";

            $mail->isHTML(true);
            $mail->send();
            echo "Reset link sent! Please check your email.";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "You are not a student of PTC.";
    }

    } else {
        echo "You are not a student of PTC.";
    }
?>

<?php
require_once 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (!isset($_GET['code'])) {
    exit('No code returned from Google.');
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    exit('Error: ' . $token['error']);
}

$client->setAccessToken($token);

// Get user information
$oauth2 = new Google\Service\Oauth2($client);
$userInfo = $oauth2->userinfo->get();

// Store user information in session
session_start();
$_SESSION['user_name'] = $userInfo->name;
$_SESSION['user_email'] = $userInfo->email;
$_SESSION['user_picture'] = $userInfo->picture;

// Generate verification code
$_SESSION['verification_code'] = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

// Send email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'mallariking0@gmail.com'; // Your Gmail
    $mail->Password = 'fjqsaqlybijqpuph'; // App Password (enable 2FA on Gmail)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('mallariking0@gmail.com', 'Verification Team');
    $mail->addAddress($userInfo->email);

    $mail->isHTML(true);
    $mail->Subject = 'Your Verification Code';
    $mail->Body = "Hello, your verification code is: <b>{$_SESSION['verification_code']}</b>";

    $mail->send();
    header('Location: verify.php');
    exit;
} catch (Exception $e) {
    exit("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}

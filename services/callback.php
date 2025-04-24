<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

$cm = new class_model();

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $google_oauth = new Google\Service\Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info->email;
   
    $user = $cm->getUserByEmail($email);

    if (!$user) {
        // Redirect to index.php with a warning message
        session_start();
        $_SESSION['error'] = 'Your PTC email does not have records in the database. Please contact MIS.';
        header('Location: ../index.php');
        exit();
    }

    session_start();
    $_SESSION['sessionuser'] = $user;

    header('Location: ../student/index.php');
    exit();
} else {
    echo "Invalid access.";
}

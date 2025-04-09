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

    session_start();
    $_SESSION['sessionuser'] = $user;
  

    header('Location: ../dashboard.php');
    exit();
} else {
    echo "Invalid access.";
}

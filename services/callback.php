<?php
require_once 'config.php';

require 'vendor/autoload.php';

if (!isset($_GET['code'])) {
    exit('No code returned from Google.');
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    exit('Error: ' . $token['error']);
}

$client->setAccessToken($token);

$oauth2 = new Google\Service\Oauth2($client);
$userInfo = $oauth2->userinfo->get();


$_SESSION['user_name'] = $userInfo->name;
$_SESSION['user_email'] = $userInfo->email;
$_SESSION['user_picture'] = $userInfo->picture;


// header('Location: ./login/dashboard.php');
// exit;

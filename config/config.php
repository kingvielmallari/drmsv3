<?php
require_once __DIR__ . '/../vendor/autoload.php';


$client = new Google_Client();
$client->setClientId('355312799011-au3dfukn4haa9pe0l5hqi5rh8da0g6su.apps.googleusercontent.com');
$client->setClientSecret('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');
// $client->setRedirectUri('http://localhost/drmsv3/services/callback.php');


if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $redirectUri = 'http://localhost/drmsv3/services/callback.php';
} else {
    $redirectUri = 'https://ptc.ninja/services/callback.php';
}

$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');
$client->setPrompt('select_account');

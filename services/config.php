<?php
require 'vendor/autoload.php';

session_start();

$client = new Google\Client();
$client->setClientId('672703665912-dthgkrkrl3alrv6k1vk624hdkrlesgmf.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/drmsv3/services/callback.php');
$client->addScope('email');
$client->addScope('profile');
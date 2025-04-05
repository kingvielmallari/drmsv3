<?php
require_once 'config/db.php'; // Include your class


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $captcha_response = $_POST['cf-turnstile-response'] ?? ''; // Get CAPTCHA response token
    $secret_key = "0x4AAAAAABDnSZHD-QGIwH9EbghtEvJpp3w"; // Replace with your Cloudflare Secret Key

    if (!$captcha_response) {
        die("CAPTCHA is required.");
    }

    // Verify with Cloudflare Turnstile API
    $verify_url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
    $data = [
        'secret' => $secret_key,
        'response' => $captcha_response
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($verify_url, false, $context);
    $response_data = json_decode($result, true);

    if ($response_data["success"]) {
        echo "CAPTCHA verification passed! Form submitted successfully.";
        // Process the form (e.g., Save to database)
    } else {
        echo "CAPTCHA verification failed! Please try again.";
    }
}
?>



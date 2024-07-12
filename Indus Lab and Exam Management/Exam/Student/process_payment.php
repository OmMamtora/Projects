<?php
// PayPal API Credentials
$clientID = 'XLD9F38Y8XRPC';
$clientSecret = 'YOUR_PAYPAL_CLIENT_SECRET';

// PayPal API Endpoint
$apiEndpoint = 'https://api.paypal.com';

// PayPal API Version
$apiVersion = 'v1';

// Set up PayPal API request headers
$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($clientID . ':' . $clientSecret),
);

// Prepare payload data for PayPal payment
$data = array(
    'intent' => 'sale',
    'payer' => array(
        'payment_method' => 'paypal',
    ),
    'transactions' => array(
        array(
            'amount' => array(
                'total' => '10.00', // Total payment amount
                'currency' => 'USD', // Currency
            ),
        ),
    ),
    'redirect_urls' => array(
        'return_url' => 'http://example.com/payment_success.php', // Redirect URL on successful payment
        'cancel_url' => 'http://example.com/payment_cancel.php', // Redirect URL on payment cancellation
    ),
);

// Convert payload data to JSON format
$payload = json_encode($data);

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $apiEndpoint . '/' . $apiVersion . '/payments/payment');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($curl);

// Close cURL session
curl_close($curl);

// Decode JSON response from PayPal
$responseData = json_decode($response, true);

// Redirect to PayPal payment approval URL
header('Location: ' . $responseData['links'][1]['href']);
exit;
?>

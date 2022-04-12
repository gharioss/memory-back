<?php
require 'bootstrap.php';


use Carbon\Carbon;

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $key = json_decode($postdata)->token;
}


// get the local secret key
$secret = getenv('SECRET');

if (!isset($key)) {
    exit('Please provide a key to verify');
}

$jwt = $key;


// split the token
$tokenParts = explode('.', $jwt);
$header = base64_decode($tokenParts[0]);
$payload = base64_decode($tokenParts[1]);
$signatureProvided = $tokenParts[2];



// check the expiration time - note this will cause an error if there is no 'exp' claim in the token
$expiration = Carbon::createFromTimestamp(json_decode($payload)->exp);
$tokenExpired = (Carbon::now()->diffInSeconds($expiration, false) < 0);

// echo $tokenExpired;
// build a signature based on the header and payload using the secret

//Encode Header
$base64UrlHeader = base64UrlEncode($header);

//Encode Payload
$base64UrlPayload = base64UrlEncode($payload);

//Create a Signature Hash
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

//Encore Signature to Base64Url String
$base64UrlSignature = base64UrlEncode($signature);

// echo $jwt . "\n";
// echo $signatureProvided . "\n";
// echo $base64UrlSignature . "\n";

// verify it matches the signature provided in the token
$signatureValid = ($base64UrlSignature === $signatureProvided);

// echo "Header:\n" . $header . "\n";
// echo "Payload:\n" . $payload . "\n";

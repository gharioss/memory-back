<?php
require 'bootstrap.php';

function JWT($id_user, $email)
{
    //get the local secret key
    $secret = getenv('SECRET');

    //Create the token header
    $header = json_encode([
        'typ' => 'JWT',
        'alg' => 'HS256'
    ]);

    //Create the token payLoad
    $payload = json_encode([
        'id_user' => $id_user,
        'email' => $email,
        'exp' => time() + 60 * 60 * 24
    ]);

    //Encode Header
    $base64UrlHeader = base64UrlEncode($header);

    //Encode Payload
    $base64UrlPayload = base64UrlEncode($payload);

    //Create a Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

    //Encore Signature to Base64Url String
    $base64UrlSignature = base64UrlEncode($signature);

    //Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    return $jwt;
}

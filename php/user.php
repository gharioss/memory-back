<?php

header('Access-Control-Allow-Origin: https://memoryfrontjulie.herokuapp.com');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");


require 'db.php';
require '../validate_jwt.php';


// $user = [];

if ($signatureValid && !$tokenExpired) {
    $id_user = json_decode($payload)->id_user;
    $stmt = $pdo->query("SELECT * FROM users WHERE id_user = $id_user");
    $fetch = $stmt->fetch();

    echo json_encode($fetch);
} else {
    echo json_encode("Something went wront");
}

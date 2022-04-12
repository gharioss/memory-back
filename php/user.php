<?php

require 'db.php';
require '../validate_jwt.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");


// $user = [];

if ($signatureValid && !$tokenExpired) {
    $id_user = json_decode($payload)->id_user;
    $stmt = $pdo->query("SELECT * FROM users WHERE id_user = $id_user");
    $fetch = $stmt->fetch();

    echo json_encode($fetch);
} else {
    echo json_encode("Something went wront");
}

<?php



require 'db.php';
require '../validate_jwt.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}


// $user = [];

if ($signatureValid && !$tokenExpired) {
    $id_user = json_decode($payload)->id_user;
    $stmt = $pdo->query("SELECT * FROM users WHERE id_user = $id_user");
    $fetch = $stmt->fetch();

    echo json_encode($fetch);
} else {
    echo json_encode("Something went wront");
}

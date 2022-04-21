<?php

require 'db.php';
require '../validate_jwt.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE,OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

$myProfile = [];
if ($signatureValid && !$tokenExpired) {
    $id_user = json_decode($payload)->id_user;
    $stmt = $pdo->query("SELECT * FROM users
                        LEFT JOIN results ON users.id_user = results.id_user
                        WHERE users.id_user = $id_user");

    if ($stmt) {
        $cr = 0;
        foreach ($stmt as $mP) {
            $myProfile[$cr]['first_name'] = $mP['first_name'];
            $myProfile[$cr]['last_name'] = $mP['last_name'];
            $myProfile[$cr]['email'] = $mP['email'];
            $myProfile[$cr]['result'] = $mP['result'];
            $myProfile[$cr]['date'] = $mP['date'];
            $cr++;
        }
    }

    echo json_encode($myProfile);
} else {
    echo json_encode("Something went wront");
}

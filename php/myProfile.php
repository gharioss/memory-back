<?php
header('Access-Control-Allow-Origin: https://memoryfrontjulie.herokuapp.com/');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');

require 'db.php';
require '../validate_jwt.php';

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

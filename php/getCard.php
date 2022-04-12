<?php

require 'db.php';
header("Access-Control-Allow-Origin: https://memoryfrontjulie.herokuapp.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

$cards = [];
$stmt = $pdo->query("SELECT * FROM cards");
if ($stmt) {
    $cr = 0;
    foreach ($stmt as $card) {
        $cards[$cr]['src'] = $card['pic_card'];
        $cr++;
    }
    echo json_encode($cards);
}

<?php
require 'db.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

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

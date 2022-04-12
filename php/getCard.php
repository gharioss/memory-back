<?php

require 'db.php';

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

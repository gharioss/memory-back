<?php

header("Access-Control-Allow-Origin: https://memoryfrontjulie.herokuapp.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: * ");

try {
    $pdo = new PDO('mysql:host=spryrr1myu6oalwl.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=qx0inh95bxegsxdz;charset=utf8', 'mdwrkz40on3tdyns', 'jqooany1lacnid2a', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

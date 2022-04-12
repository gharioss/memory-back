<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

try {
    $pdo = new PDO('mysql:host=spryrr1myu6oalwl.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=qx0inh95bxegsxdz;charset=utf8', 'mdwrkz40on3tdyns', 'jqooany1lacnid2a', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

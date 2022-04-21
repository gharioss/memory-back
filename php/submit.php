<?php


require 'db.php';
require '../validate_jwt.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE,OPTIONS');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $decoded = json_decode($postdata);

    $result = $decoded->result;

    if ($signatureValid && !$tokenExpired) {
        $id_user = json_decode($payload)->id_user;


        $sql = $pdo->prepare("INSERT INTO results (result, date, id_user) VALUES (:result, now(), :id_user)");
        $sql->bindParam(":result", $result);
        $sql->bindParam(":id_user", $id_user);
        $sql->execute();

        if ($sql) {
            echo "is good";
        } else {
            print_r('it didnt work');
        }
    }
}

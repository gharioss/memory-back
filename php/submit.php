<?php
require 'db.php';
require '../validate_jwt.php';
header("Access-Control-Allow-Origin: https://memoryfrontjulie.herokuapp.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

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

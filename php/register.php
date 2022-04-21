<?php

require 'db.php';
require '../generate_jwt.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE,OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $decoded = json_decode($postdata);

    $first_name = $decoded->first_name;
    $last_name = $decoded->last_name;
    $email = $decoded->email;
    $password = $decoded->password;


    $sql = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
    $sql->bindParam(":first_name", $first_name);
    $sql->bindParam(":last_name", $last_name);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":password", $password);
    $sql->execute();

    if ($sql) {
        $lastInsertedId = $pdo->lastInsertId();
        $sql1 = $pdo->query("SELECT * FROM users WHERE id_user = $lastInsertedId");
        $x = $sql1->fetch();
        $token = JWT($x["id_user"], $x['email']);
        $getToken['token'] = $token;
        echo json_encode($getToken);
    } else {
        print_r('it didnt work');
    }
}

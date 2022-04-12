<?php
require 'db.php';
require '../generate_jwt.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}


$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $decoded = json_decode($postdata);

    $email = $decoded->email;
    $password = $decoded->password;


    $sql = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $sql->bindParam(":email", $email);
    $sql->bindParam(":password", $password);
    $sql->execute();
    $getId = $sql->fetch();

    if ($getId) {
        $token = JWT($getId["id_user"], $getId['email']);
        $getToken['token'] = $token;
        echo json_encode($getToken);
    } else {
        print_r('it didnt work');
    }
}

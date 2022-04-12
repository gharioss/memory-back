<?php

require 'db.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}

$result = [];
$stmt = $pdo->query("SELECT results.id_user id_result, result, DATE_FORMAT(`date`, '%d/%m/%Y') as dateE, first_name, last_name
                    FROM results LEFT JOIN users ON results.id_user = users.id_user
                    ORDER BY result ASC LIMIT 10");
if ($stmt) {
    $cr = 0;
    foreach ($stmt as $student) {
        $result[$cr]['id_result'] = $student['id_result'];
        $result[$cr]['result'] = $student['result'];
        $result[$cr]['dateE'] = $student['dateE'];
        $result[$cr]['first_name'] = $student['first_name'];
        $result[$cr]['last_name'] = $student['last_name'];
        $cr++;
    }
    echo json_encode($result);
}

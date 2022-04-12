<?php
header('Access-Control-Allow-Origin: https://memoryfrontjulie.herokuapp.com');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');


require 'db.php';


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

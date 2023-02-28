<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/squad.php';
include_once dirname(__FILE__) . '/../../model/base.php';


$dtbase = new Database();
$db_conn = $dtbase->connect();

$squad = new Squad($db_conn);
$query = $squad->getArchiveSquad();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $squads_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $squad_arr = array(
            'id' => $id,
            'name' => $name,
            'nickname' => $id_trustee,
            'score' => $score,
        );
        array_push($squads_arr, $squad_arr);
    }
    http_response_code(200);
    echo (json_encode($squads_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode(["message" => "Non sono state trovate leghe con quel nome"]);
}


$conn->close();
die();
?>
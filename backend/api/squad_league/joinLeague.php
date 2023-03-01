<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/squad_league.php';
include_once dirname(__FILE__) . '/../../model/base.php';


$data = json_decode(file_get_contents("php://input"));

if (empty($data->id_squad) || empty($data->id_league)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$squad_league = new Squad_League($conn);
$query = $squad_league->joinLeague($data->id_squad, $data->id_league);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}


$conn->close();
die();
?>
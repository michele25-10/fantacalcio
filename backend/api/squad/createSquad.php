<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/squad.php';
include_once dirname(__FILE__) . '/../../model/base.php';

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->name) || empty($data->id_user)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$dtbase = new Database();
$db_conn = $dtbase->connect();

$squad = new Squad($db_conn);
$query = $squad->createSquad($data->name, $data->id_user);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["response" => true]);
} else {
    http_response_code(401);
    echo json_encode(["response" => false]);
}


$conn->close();
die();
?>
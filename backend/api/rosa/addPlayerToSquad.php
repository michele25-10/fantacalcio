<?php
require("../../common/connect.php");
require("../../model/rosa.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id_squad) || empty($data->id_league) || empty($data->id_player)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$db_conn = $db->connect();
$rosa = new Rosa($db_comm);

$result = $rosa->addPlayerToSquad($data->id_squad, $data->id_league, $data->id_player);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["response" => true]);
} else {
    http_response_code(401);
    echo json_encode(["response" => false]);
}
die();
?>
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
$conn = $db->connect();
$rosa = new Rosa($conn);

$query = $rosa->addPlayerToSquad($data->id_squad, $data->id_league, $data->id_player);
$result = $conn->query($query);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => "1"]);
} else {
    echo json_encode(["message" => "-1"]);
}
die();
?>
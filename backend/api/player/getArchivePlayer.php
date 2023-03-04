<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/player.php';
include_once dirname(__FILE__) . '/../../model/base.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$player = new Player($conn);
$query = $player->getArchivePlayer();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $players_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $player_arr = array(
            'id' => $id,
            'surname' => $surname,
            'role' => $role,
        );
        array_push($players_arr, $player_arr);
    }
    http_response_code(200);
    echo (json_encode($players_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode(["message" => "Non sono state trovate leghe"]);
}


$conn->close();
die();
?>
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/squad.php';
include_once dirname(__FILE__) . '/../../model/base.php';

if (!isset($_GET['id_squad']) || ($id = explode("?id_squad=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

//$user = explode("?user=" , $_SERVER['REQUEST_URI'])[1];

$dtbase = new Database();
$conn = $dtbase->connect();

$squad = new Squad($conn);
$query = $squad->getPlayerOfSquad($id);

$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $players_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $player_arr = array(
            'id' => $id,
            'surname' => $surname,
            'role' => $role
        );
        array_push($players_arr, $player_arr);
    }
    http_response_code(200);
    echo (json_encode($players_arr, JSON_PRETTY_PRINT));
} else {
    echo json_encode(["message" => "-2"]);
}

$conn->close();
die();
?>
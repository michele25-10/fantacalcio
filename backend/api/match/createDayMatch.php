<?php

header("Content-type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/match.php';
include_once dirname(__FILE__) . '/../../model/base.php';
include_once dirname(__FILE__) . '/../../model/squad_league.php';

if (!isset($_GET['id_league']) || ($id_league = explode("?id_league=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$league = new Squad_League($conn);
$query = $league->getSquadJoinLeagueMatch($id_league);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $squads_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $squad_arr = $id;
        array_push($squads_arr, $squad_arr);
    }
}
$squads2_arr = $squads_arr;

var_dump($squads_arr);
shuffle($squads2_arr);
var_dump($squads2_arr);


?>
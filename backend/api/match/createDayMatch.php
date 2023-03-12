<?php

header("Content-type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/match.php';
include_once dirname(__FILE__) . '/../../model/base.php';
include_once dirname(__FILE__) . '/../../model/squad_league.php';
include_once dirname(__FILE__) . '/../../model/squad.php';
include_once dirname(__FILE__) . '/../../model/league.php';


if (!isset($_GET['id_league']) || ($id_league = explode("?id_league=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$match = new Matches($conn);
$query = $match->getLastNumberMatch($id_league);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $number_match = $numbermatch;
    }
} else {
    $number_match = 0;
}

if ($number_match == 38) {
    //termina la lega
    $league = new League($conn);
    $query = $league->closeLeague($id_league);
    $result = $conn->query($query);
    echo json_encode(["message" => "Campionato concluso"]);
} else {
    $squad_league = new Squad_League($conn);
    $squad = new Squad($conn);

    $query = $squad_league->getSquadJoinLeagueMatch($id_league);
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        $squads_arr = array();
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $squad_arr = $id;
            array_push($squads_arr, $squad_arr);
        }
    }

    $lunghezza = count($squads_arr);
    $number_match = $number_match + 1;

    for ($x = 0; $x < $lunghezza; $x++) {

        // query di inserimento nel db della giornata
        $score = rand(0, 150);
        $id_squad = $squads_arr[$x];

        $query = $match->createMatch($number_match, $id_squad, $score, $id_league); //Insert dei punteggi della squadra nella giornata simulata
        $result = $conn->query($query);

        $query = $squad->updateScore($id_squad, $score); //update punteggi della squadra nella tabella squad
        $result = $conn->query($query);
    }

    echo json_encode(["message" => "1"]);

}

?>
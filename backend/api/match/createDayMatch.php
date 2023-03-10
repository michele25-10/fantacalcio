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
    //updateStatus
} else {
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
    shuffle($squads2_arr);
    $lunghezza = count($squads_arr);

    for ($x = 0; $x < $lunghezza; $x) {
        if ($squads_arr[$x] == $squads2_arr[$x]) {
            $score1 = rand(0, 150);
            $id_squad1 = $squads_arr[$x];
            $number_match = $number_match + 1;

            //uno scontro da solo
        } else {
            // query di inserimento nel db della giornata
            $score1 = rand(0, 150);
            $score2 = rand(0, 150);
            $number_match = $number_match + 1;
            $id_squad1 = $squads_arr[$x];
            $id_squad2 = $squads2_arr[$x];

            $query = $match->createMatch($number_match, $id_squad1, $id_squad2, $score1, $score2, $id_league);
            var_dump($query);
            $result = $conn->query($query);

        }
    }

}

?>
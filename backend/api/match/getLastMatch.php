<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/match.php';
include_once dirname(__FILE__) . '/../../model/base.php';

if (!isset($_GET['id_league']) || ($id_league = explode("?id_league=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode("Non ci sono abbastanza campi per la ricerca");
    die();
}
if (!isset($_GET['number_match']) || ($number_match = explode("&number_match=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode("Non ci sono abbastanza campi per la ricerca");
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$match = new Matches($conn);
$query = $match->getLastMatch($id_league, $number_match);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $matches_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $match_arr = array(
            'name' => $name,
            'score' => $score,
        );
        array_push($matches_arr, $match_arr);
    }
    http_response_code(200);
    echo (json_encode($matches_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}


$conn->close();
die();
?>
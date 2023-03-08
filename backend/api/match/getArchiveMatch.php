<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/match.php';
include_once dirname(__FILE__) . '/../../model/base.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$match = new Matches($conn);
$query = $match->getArchieveMatch();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $matches_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $match_arr = array(
            'id' => $id,
            'number_match' => $number_match,
            'id_squad1' => $id_squad1,
            'id_squad2' => $id_squad2,
            'score1' => $score1,
            'score2' => $score2,
            'id_league' => $id_league,
        );
        array_push($matches_arr, $match_arr);
    }
    http_response_code(200);
    echo (json_encode($matches_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode(["message" => "-1"]);
}


$conn->close();
die();
?>
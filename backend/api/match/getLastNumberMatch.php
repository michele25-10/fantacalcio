<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/match.php';
include_once dirname(__FILE__) . '/../../model/base.php';

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
    http_response_code(200);
    echo (json_encode(["message" => $number_match]));
} else {
    http_response_code(400);
    echo json_encode(["message" => "-1"]);
}


$conn->close();
die();
?>
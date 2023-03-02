<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/league.php';
include_once dirname(__FILE__) . '/../../model/base.php';

$dtbase = new Database();
$conn = $dtbase->connect();

$league = new League($conn);
$query = $league->getArchiveLeague();
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $leagues_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $league_arr = array(
            'id' => $id,
            'name' => $name,
            'id_trustee' => $id_trustee,
        );
        array_push($leagues_arr, $league_arr);
    }
    http_response_code(200);
    echo (json_encode($leagues_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode(["message" => "Non sono state trovate leghe"]);
}


$conn->close();
die();
?>
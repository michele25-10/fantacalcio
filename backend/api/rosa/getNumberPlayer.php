<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/rosa.php';
include_once dirname(__FILE__) . '/../../model/base.php';

if (!isset($_GET['id_squad']) || ($id_squad = explode("?id_squad=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

//$user = explode("?user=" , $_SERVER['REQUEST_URI'])[1];

$dtbase = new Database();
$conn = $dtbase->connect();

$rosa = new Rosa($conn);
$query = $rosa->getNumberPlayer($id_squad);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $rose_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $rosa_arr = array(
            'number' => $count_player,
        );
        array_push($rose_arr, $rosa_arr);
    }
    http_response_code(200);
    echo (json_encode($rose_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode(["message" => "Non sono state trovate leghe con quel nome"]);
}


$conn->close();
die();
?>
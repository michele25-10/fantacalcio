<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/league.php';
include_once dirname(__FILE__) . '/../../model/base.php';


if (!isset($_GET['id_user']) || ($id = explode("?id_user=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

$dtbase = new Database();
$conn = $dtbase->connect();

$league = new League($conn);
$query = $league->checkTrustee($id);
$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $leagues_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $league_arr = array(
            'id_trustee' => $id_trustee,
        );
        array_push($leagues_arr, $league_arr);
    }
    if ($leagues_arr[0]['id_trustee'] == $id) {
        echo (json_encode(["message" => "0"]));
    } else {
        echo (json_encode(["message" => "-1"]));
    }
} else {
    echo json_encode(["message" => "-1"]);
}


$conn->close();
die();
?>
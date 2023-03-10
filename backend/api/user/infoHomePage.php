<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../../common/connect.php';
include_once dirname(__FILE__) . '/../../model/user.php';
include_once dirname(__FILE__) . '/../../model/base.php';

if (!isset($_GET['id_user']) || ($id = explode("?id_user=", $_SERVER['REQUEST_URI'])[1]) == null) {
    http_response_code(400);
    echo json_encode(["message" => "Non ci sono abbastanza campi per la ricerca"]);
    die();
}

//$user = explode("?user=" , $_SERVER['REQUEST_URI'])[1];

$dtbase = new Database();
$conn = $dtbase->connect();

$user = new User($conn);
$query = $user->infoHomePage($id);

$result = $conn->query($query);

if (mysqli_num_rows($result) > 0) {
    $users_arr = array();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $user_arr = array(
            'nickname' => $nickname,
            'name' => $name,
        );
        array_push($users_arr, $user_arr);
    }
    http_response_code(200);
    echo (json_encode($users_arr, JSON_PRETTY_PRINT));
} else {
    http_response_code(400);
    echo json_encode("-1");
}
$conn->close();
die();
?>
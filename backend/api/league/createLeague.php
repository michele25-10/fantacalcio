<?php
require("../../common/connect.php");
require("../../model/league.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->name) || empty($data->user_id)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$db_conn = $db->connect();
$user = new League($db_comm);

$result = $user->createLeague($data->name, $data->user_id);

if ($result != false) {
    http_response_code(200);
    echo json_encode(["response" => true]);
} else {
    http_response_code(401);
    echo json_encode(["response" => false]);
}
die();
?>
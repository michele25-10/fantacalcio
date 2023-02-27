<?php
require __DIR__ . '/../../common/connect.php';
require __DIR__ . '/../../model/user.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->nickname) || empty($data->pw)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$db_conn = $db->connect();
$user = new User($db_conn);

if ($user->registration($data->nickname, $data->pw) == true) {
    echo json_encode(["message" => "1"]);
} else {
    echo json_encode(["message" => "-1"]);
}
?>
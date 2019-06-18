<?php

require_once "../classes/user.php";
require_once "../classes/database.php";


$database = new Database();

$user = new User($database->getConnection());

$user->id  = isset($_GET['id']) ? $_GET['id'] : die();

$data = json_decode(file_get_contents("php://input"));

$user->fullName = $data->fullName;
$user->username = $data->username;
$user->password = $data->password;

if ($user->update()) {

    http_response_code(200);

    echo json_encode(array("data was updated"));
} else {

    http_response_code(503);

    echo json_encode(array("data not updated"));
}

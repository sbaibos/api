<?php

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// require include database and object file
require_once "../objects/project.php";
require_once "../objects/database.php";

// get database connection
$database = new Database();
// prepare project object
$project = new Project($database->getConnection());

// get project id
$project->id = isset($_GET['id']) ? $_GET['id'] : die();
// set project id to be deleted
if ($project->delete()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "project was deleted."));
} else {

    http_response_code(503);

    echo json_encode(array("message" => "Unable to delete project"));
}

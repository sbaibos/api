<?php

require_once "../classes/project.php";
require_once "../classes/database.php";


$database = new Database();

$project = new Project($database->getConnection());

$project->id  = isset($_GET['id']) ? $_GET['id'] : die();

$data = json_decode(file_get_contents("php://input"));

$project->name = $data->name;
$project->employer = $data->employer;
$project->dateStartEnd = $data->dateStartEnd;
$project->description = $data->description;
$project->analyticalDescription = $data->analyticalDescription;
$project->siteUrl = $data->siteUrl;
$project->photo = $data->photo;
$project->technologiesUsed = $data->technologiesUsed;

if ($project->update()) {

    http_response_code(200);

    echo json_encode(array("data was updated"));
} else {

    http_response_code(503);

    echo json_encode(array("data not updated"));
}

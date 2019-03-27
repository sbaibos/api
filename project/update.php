<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/project.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare project object
$project = new project($db);

// get id of project to be edited
$data = json_decode(file_get_contents("php://input"));

 
// set ID property of project to be edited
$project->id = $data->id;
// set ID property of record to read
//$project->id = isset($_GET['id']) ? $_GET['id'] : die();

 
// set project property values
$project->name = $data->name;
$project->employer = $data->employer;
$project->dateStartEnd = $data->dateStartEnd;
$project->description = $data->description;
 $project->analyticalDescription = $data->analyticalDescription;
 $project->siteUrl = $data->siteUrl;
$project->photo = $data->photo;
$project->technologiesUsed = $data->technologiesUsed;
//var_dump($project->id);
// var_dump($project->employer);
// var_dump($project->dateStartEnd);
// var_dump($project->description);
// var_dump($project->analyticalDescription);
// var_dump($project->siteUrl);
// var_dump($project->photo);
// var_dump($project->technologiesUsed);
 
// update the project
if($project->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "project was updated."));
}
 
// if unable to update the project, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update project."));
}
?>

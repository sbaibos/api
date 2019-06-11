<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
require_once "../classes/project.php";
require_once "../classes/database.php";

 $id;

// get database connection
$database = new Database();

// prepare project object
$project = new Project($database->getConnection());

//if the id exists in the url then get it or exit
$project->id = isset($_GET['id']) ? $_GET['id'] :die();

//call the method
$read_by_id = $project->read_by_id();

//create a row
$row = $read_by_id->fetch(PDO::FETCH_ASSOC);
//extract($row);
        // set values to object properties
         $project->id = $row['id'];
         $project->name = $row['name'];
         $project->employer = $row['employer'];
         $project->dateStartEnd = $row['dateStartEnd'];
         $project->description = $row['description'];
         $project->analyticalDescription = $row['analyticalDescription'];
         $project->siteUrl = $row['siteUrl'];
         $project->photo = $row['photo'];
         $project->technologiesUsed = $row['technologiesUsed'];

//if project name is not null
if($project->name!=null){

//create an array
$project_arr = array(

    "id"=> $project->id,
    "name"=> $project->name,
    "employer"=> $project->employer,
    "dateStartEnd"=> $project->dateStartEnd,
    "description"=> $project->description,
    "analyticalDescription"=> $project->analyticalDescription,
    "siteUrl"=> $project->siteUrl,
    "photo"=> $project->photo,
    "technologiesUsed"=> $project->technologiesUsed

);

// set response code - 200 OK
http_response_code(200);
 
// make it json format
echo json_encode($project_arr);

} else {


     // set response code - 404 Not found
     http_response_code(404);
 
     // tell the user project does not exist
     echo json_encode(array("message" => "Project does not exist."));
}


?>
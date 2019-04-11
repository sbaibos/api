<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../objects/project.php";
require_once "../objects/database.php";


$database = new Database();

$project = new Project($database->getConnection());

$read = $project->read();
$num = $read->rowCount();

if($num>0){
 
    // products array
    $projects_arr=array();
    
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $read->fetch(PDO::FETCH_ASSOC)){

        
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $project_item=array(
            "id" => $id,
            "name" => $name,
			"employer" => $employer,
			"dateStartEnd"=>$dateStartEnd,
            "description" => html_entity_decode($description),
			"analyticalDescription"=>$analyticalDescription,
			"siteUrl"=>$siteUrl,
			"photo"=>$photo,
			"technologiesUsed"=>$technologiesUsed
            
        );
 
        array_push($projects_arr, $project_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($projects_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No projects found.")
    );
}




?>
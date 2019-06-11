<?php

require_once "../classes/project.php";
require_once "../classes/database.php";

$database =  new Database();
// instantiate product object with database connection as argument
$project = new Project($database->getConnection());

// get posted data, because its json we need file_get_contents, php://input is a stream
$data = json_decode(file_get_contents(("php://input")));
// make sure data is not empty
if (
    !empty($data->name) &&
    !empty($data->employer) &&
    !empty($data->dateStartEnd) &&
    !empty($data->description) &&
    !empty($data->analyticalDescription) &&
    !empty($data->siteUrl) &&
    !empty($data->photo) &&
    !empty($data->technologiesUsed)
) {

    // set product property values
    $project->name = $data->name;
    $project->employer = $data->employer;
    $project->dateStartEnd = $data->dateStartEnd;
    $project->description = $data->description;
    $project->analyticalDescription = $data->analyticalDescription;
    $project->siteUrl = $data->siteUrl;
    $project->photo = $data->photo;
    $project->technologiesUsed = $data->technologiesUsed;
    $project->created = date('Y-m-d H:i:s');




    // create the product
    if ($project->add()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}

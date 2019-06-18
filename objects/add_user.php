<?php

require_once "../classes/user.php";
require_once "../classes/database.php";

$database =  new Database();
// instantiate product object with database connection as argument
$user = new User($database->getConnection());

// get posted data, because its json we need file_get_contents, php://input is a stream
$data = json_decode(file_get_contents(("php://input")));
// var_dump($data) ;
// make sure data is not empty
if (
    !empty($data->fullName) &&
    !empty($data->username) &&
    !empty($data->password)
    
) {

    // set product property values
    $user->fullName = $data->fullName;
    $user->username = $data->username;
    $user->password = $data->password;
    $user->created = date('Y-m-d H:i:s');




    // create the product
    if ($user->add()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "User was created."));
    }

    // if unable to create the user, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create user."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
   
}

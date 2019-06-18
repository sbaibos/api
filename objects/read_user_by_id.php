<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
require_once "../classes/user.php";
require_once "../classes/database.php";

 $id;

// get database connection
$database = new Database();

// prepare user object
$user = new User($database->getConnection());

//if the id exists in the url then get it or exit
$user->id = isset($_GET['id']) ? $_GET['id'] :die();

//call the method
$read_by_id = $user->read_by_id();

//create a row
$row = $read_by_id->fetch(PDO::FETCH_ASSOC);
//extract($row);
        // set values to object properties
         $user->id = $row['id'];
         $user->fullName = $row['fullName'];
         $user->username = $row['username'];
         $user->password = $row['password'];
        

//if user name is not null
if($user->username!=null){

//create an array
$user_arr = array(

    "id"=> $user->id,
    "fullName"=> $user->fullName,
    "username"=> $user->username,
    "password"=> $user->password 

);

// set response code - 200 OK
http_response_code(200);
 
// make it json format
echo json_encode($user_arr);

} else {


     // set response code - 404 Not found
     http_response_code(404);
 
     // tell the user user does not exist
     echo json_encode(array("message" => "user does not exist."));
}


?>
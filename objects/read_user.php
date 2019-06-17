<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../classes/user.php";
require_once "../classes/database.php";


$database = new Database();

$user = new User($database->getConnection());

$read = $user->read();
$num = $read->rowCount();

if($num>0){
 
    // users array
    $users_arr=array();
    
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $read->fetch(PDO::FETCH_ASSOC)){

        
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $user_item=array(
            "id" => $id,
            "full_name" => $full_name,
			"username" => $username,
			"password"=>$password
             );
 
        array_push($users_arr, $user_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($users_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No users found.")
    );
}




?>
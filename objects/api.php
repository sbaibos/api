<?php 


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 


$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$project_id = isset($_GET['id']);


if($request_method === 'get' &! $project_id){

    include_once 'read.php';

} else if ($request_method === 'get' && $project_id){
include_once 'read_one.php';

} else if ($request_method === 'post'){

    include_once 'add.php';
} else if ($request_method === 'put') {

    include_once 'update.php';
                                    } 
else if ($request_method === 'delete'){

    include_once 'delete.php';
} 


 














?>
<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Member.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate member object
$member = new Member($db);

//Get the raw posted data
$data = json_decode(file_get_contents("php://input"));

$member->password = $data->password;
$member->first_name = $data->first_name;
$member->last_name = $data->last_name;
$member->city = $data->city;
$member->postal = $data->postal;
$member->street = $data->street;
$member->phone = $data->phone;
$member->email = $data->email;

//Create the post
if($member->create()){
    echo json_encode(
        array('message' => 'Post Created')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
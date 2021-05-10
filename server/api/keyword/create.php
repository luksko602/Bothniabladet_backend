<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Keyword.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate member object
$keyword = new Keyword($db);

//Get the raw posted data
$keyword->keyword = $_POST['keyword'];

if($keyword->create()){
    echo json_encode(
        array('message' => 'Keyword '.$keyword->keyword.' Created')
    );
}else{
    echo json_encode(
        array('message' => 'Keyword not created')
    );
}
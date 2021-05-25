<?php

//author: Lukas Skog Andersen
//A api to create a keyword in the database

//Headers, only POST allowed
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Keyword.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate Keyword object
$keyword = new Keyword($db);

//Get the raw posted data
$keyword->keyword = $_POST['keyword'];

//Creates the keyword in the database.
if($keyword->create()){
    //If successful
    echo json_encode(
        array('message' => 'Keyword '.$keyword->keyword.' Created')
    );
}else{
    //If failed
    echo json_encode(
        array('message' => 'Keyword not created')
    );
}
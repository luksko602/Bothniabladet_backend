<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Keyword.php';
include_once '../../models/Image.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate member object
$keyword = new Keyword($db);
$image = new Image($db);

//Get the raw posted data
$keyword->keyword = $_POST['keyword'];
$image->ID_image = $_POST['ID_image'];

if($keyword->image_connect($image->ID_image)){
    echo json_encode(
        array('message' => 'Keyword '.$keyword->keyword.' and image #'. $image->ID_image. ' connected.')
    );
}else{
    echo json_encode(
        array('message' => 'Could not create connection.')
    );
}
<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);

//Get ID
$image->ID_image = isset($_GET['id']) ? $_GET['id'] : die();

//Get single image
$image->read_single();

//Create array
$image_arr = array(
    'ID_image' => $image->ID_image,
    'imageURL' => 'http://localhost/bothniabladet/Bothniabladet_backend/server/images/'.$image->imageURL,
    'resolution' => $image->resolution,
    'file_size' => $image->file_size,
    'file_type' => $image->file_type,
    'GPS_coordinates' => $image->GPS_coordinates,
    'photographer' => $image->photographer,
    'location' => $image->location,
    'date' => $image->date,
    'camera' => $image->camera,
);

//Make JSON
print_r(json_encode($image_arr));

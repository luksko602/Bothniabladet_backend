<?php

//author: Lukas Skog Andersen
//A api to read a single image from the database

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

//Local url, would be replaced in production
const localURL = 'http://localhost/bothniabladet/Bothniabladet_backend/server/images/';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);

//Get ID, if missing die
$image->ID_image = isset($_GET['id']) ? $_GET['id'] : die();

//Get single image
$image->read_single();

//Makes an array of errors and adds them if any found.
$errors =[];
if ($image->limited_usage == 0 ){
    //If the picutre has run out of usages
    $errors['error'] = "That image has run out of usages.";
}
if($image->published == 0){
    //If the picture is not published
    $errors['error_2'] = "That image is not published.";   
}

//If there are any errors, they are returned and function exits
if(!$errors == null){
    echo json_encode(
        $errors
    );
    exit;
}

//If no errors, continue with creating array
$image_arr = array(
    'ID_image' => $image->ID_image,
    'imageURL' => localURL.$image->imageURL,
    'resolution' => $image->resolution,
    'file_size' => $image->file_size,
    'file_type' => $image->file_type,
    'GPS_coordinates' => $image->GPS_coordinates,
    'photographer' => $image->photographer,
    'location' => $image->location,
    'date' => $image->date,
    'camera' => $image->camera,
    'limited_usage' => $image->limited_usage,
    'published' => $image->published
);
//Make JSON and return
print_r(json_encode($image_arr));



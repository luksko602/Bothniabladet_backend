<?php

//author: Lukas Skog Andersen
//A api to read all images from the database

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
require_once '../../models/Image.php';

//The local url for this project. Would be replaced in production.
const localURL = 'http://localhost/bothniabladet/Bothniabladet_backend/server/images';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);

//Image query
$result = $image->read();
//Get row count
$num = $result->rowCount();

//Check if any images
if($num > 0){
    //Image array
    $image_arr = array();
    $image_arr['images'] = array ();

    //Add pictures to the array
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        if ($limited_usage == 0 OR $published == 0) { continue;};
        $image_item = array(
            'ID_image' => $ID_image,
            'imageURL' => localURL.$imageURL,
            'resolution' => $resolution,
            'file_size' => $file_size,
            'file_type' => $file_type,
            'GPS_coordinates' => $GPS_coordinates,
            'photographer' => $photographer,
            'location' => $location,
            'date' => $date,
            'camera' => $camera,
            'limited_usage' => $limited_usage,
            'published' => $published

        );
        
        //Push to "data"
        array_push($image_arr['images'], $image_item);
    }
    
    //Echos image array as json
    echo json_encode($image_arr);
}else{
    //No images
    echo json_encode(
        array('message' => 'No images found')
    );
}
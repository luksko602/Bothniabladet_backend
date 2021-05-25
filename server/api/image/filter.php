<?php

//author: Lukas Skog Andersen
//A api to search for images with an array or single key.

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
require_once '../../models/Image.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);

//Image query
$keys = $_GET["keys"];

//Search for images with keys
$result = $image->filter($keys);

//Get row count
$num = $result->rowCount();

//Check if any images
if($num > 0){
    //Image array
    $image_arr = array();
    $image_arr['images'] = array ();

    //Loop the images found
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if ($limited_usage == 0 ){
            //If the picutre has run out of usages skip iteration
            continue;
        }
        if($published == 0){
            //If the picture is not published skip iteration
            continue;   
        }

        //if no errors, add the image to the array
        $image_item = array(
            'ID_image' => $ID_image,
            'imageURL' => 'http://localhost/bothniabladet/Bothniabladet_backend/server/images/'.$imageURL,
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
    
    //Turn to JSON & output
    echo json_encode($image_arr);
}else{
    //No images
    echo json_encode(
        array('message' => 'No images found')
    );


}
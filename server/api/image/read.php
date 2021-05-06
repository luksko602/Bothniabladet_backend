<?php
//Header
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
$result = $image->read();
//Get row count
$num = $result->rowCount();

//Check if any images
if($num > 0){
    //Image array
    $image_arr = array();
    $image_arr['images'] = array ();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $image_item = array(
            'ID_image' => $ID_image,
            'imageURL' => 'http://localhost/bothniabladet/Bothniabladet_backend/server/images'.$imageURL,
            'resolution' => $resolution,
            'file_size' => $file_size,
            'file_type' => $file_type,
            'GPS_coordinates' => $GPS_coordinates,
            'photographer' => $photographer,
            'location' => $location,
            'date' => $date,
            'camera' => $camera
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
<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

$database = new Database();
$db = $database -> connect();

$image = new Image($db);

$id = $_POST['ID_image'] ?? null;

if (!$id) {
    echo json_encode(
        array('message' => 'Please enter the id you want to update.')
    );
    exit;
}
//Reads in the existing data
$image->ID_image = $id;
$image->read_single();

    //Sets new data if they are available
    if (isset($_POST['resolution'])){
        $image->resolution = $_POST['resolution'];
       }  

       if (isset($_POST['GPS_coordinates'])){
        $image->GPS_coordinates = $_POST['GPS_coordinates'];
       }  
    
       if (isset($_POST['photographer'])){
        $image->photographer = $_POST['photographer'];
       }

       if (isset($_POST['camera'])){
        $image->camera = $_POST['camera'];
       }

       if (isset($_POST['location'])){
        $image->location = $_POST['location'];
       }
      
       if (isset($_POST['limited_usage'])){
        $image->limited_usage = $_POST['limited_usage'];
       }
    
       if (isset($_POST['published'])){
        $image->published = $_POST['published'];
       }
       
if($image->update()){
    echo json_encode(
        array('message' => 'Image '.$image->ID_image.' Updated')
    );
    }else{
        echo json_encode(
            array('message' => 'Image Not Updated')
        );
    }
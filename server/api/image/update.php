<?php

//author: Lukas Skog Andersen
//A api to update image-data

//Headers, only POST allowed.
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

//Creates a DB connection
$database = new Database();
$db = $database -> connect();

//Instantiate Image object.
$image = new Image($db);

//Get the raw posted data, if missing it is set to null
$id = $_POST['ID_image'] ?? null;

//If id is missing, throws an error message
if (!$id) {
    echo json_encode(
        array('message' => 'Please enter the id you want to update.')
    );
    exit;
}

//Reads the existing data from the object
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
       
//Updates the image in the database
if($image->update()){
    //IF successful
    echo json_encode(
        array('message' => 'Image '.$image->ID_image.' Updated')
    );
    }else{
        //If failed
        echo json_encode(
            array('message' => 'Image Not Updated')
        );
    }
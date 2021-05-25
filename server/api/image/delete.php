<?php

//author: Lukas Skog Andersen
//A api to delete an image by its ID

//Headers, only POST allowed
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

//Create a DB connection
$database = new Database();
$db = $database -> connect();

//Instantiate Image object
$image = new Image($db);

//Makes sure the ID is provided.
$id = $_POST['ID_image'] ?? null;

//If no id, throw error message and exit
if (!$id) {
    echo json_encode(
        array('message' => 'Please enter the id you want to delete.')
    );
    exit;
}

//Set the id of the Image object
$image->ID_image = $id;

//Get the single image. Makes sure the picture is in the database.
$image->read_single();

//Creates the path for the file and directory which it is stored in.
$path = "../../images";
$file = $path.$image->imageURL;
$dir = ($path.'/'.explode("/",$image->imageURL)[1]);

//Delete the image object
if($image->delete()){
    //If deleted from the database, remove the file and its directory
    unlink($file);
    rmdir($dir);
    //Echo the result
    echo json_encode(
        array('message' => 'Image '.$image->ID_image.' Deleted')
    );
    }else{
        //If something went wrong
        echo json_encode(
            array('message' => 'Image Not Deleted')
        );
    }
<?php

//author: Lukas Skog Andersen
//A api to get all keywords related to a specific image.

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once '../../models/Keyword.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate Image and Keyword object
$image = new Image($db);
$keyword = new Keyword($db);

//Get ID, if id is missing the function dies.
$image->ID_image = isset($_GET['id']) ? $_GET['id'] : die();

    //Get the single image. Makes sure the picture is in the database.
    $image->read_single();

    //Get keywords related to the image. image ID is passed as argument.
    $result = $keyword->read_by_id_image($image->ID_image);
    
    //Get row count
    $num = $result->rowCount();
    //Check if any posts
    if($num > 0){
        //Keyword array
        $key_arr = array();
        $key_arr['keywords'] = array ();

        //Adds all keywords found
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            //Push to "data"
            array_push($key_arr['keywords'], $keyword);
        }
        //Echo result as json
        echo json_encode($key_arr);
}else{
    //If no keywords found
    echo json_encode(
        array('message' => 'No keywords found')
    );
}


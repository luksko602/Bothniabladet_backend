<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once '../../models/Keyword.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);
$keyword = new Keyword($db);

//Get ID
$image->ID_image = isset($_GET['id']) ? $_GET['id'] : die();

    //Get single image
    $image->read_single();

    //Member query
    $result = $keyword->read_by_id_image($image->ID_image);
    //Get row count
    $num = $result->rowCount();

    //Check if any posts
    if($num > 0){
        //Member array
        $key_arr = array();
        $key_arr['keywords'] = array ();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $key_item = array(
                'keyword' => $keyword
            );
            
            //Push to "data"
            array_push($key_arr['keywords'], $key_item);
        }

        //Turn to JSON & output
        echo json_encode($key_arr);
}else{
    //No members
    echo json_encode(
        array('message' => 'No keywords found')
    );
}


<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Keyword.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate member object
$keyword = new Keyword($db);

//Member query
$result = $keyword->read();
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
            'ID_keyword' => $ID_keyword,
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
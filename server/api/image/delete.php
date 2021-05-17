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
        array('message' => 'Please enter the id you want to delete.')
    );
    exit;
}

$image->ID_image = $id;

if($image->delete()){
    echo json_encode(
        array('message' => 'Image '.$image->ID_image.' Deleted')
    );
    }else{
        echo json_encode(
            array('message' => 'Image Not Deleted')
        );
    }

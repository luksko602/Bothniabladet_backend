<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once'../../functions/functions.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);

//Get the raw posted data
//$data = json_decode(file_get_contents("php://input"));

//Check if theres an image
if(!empty($_FILES['image']))
  {
    $path = "../../images";
    if (!is_dir($path)) {
                 mkdir($path);
    }
    $image_path = $path . "/" .randomString(8);
    mkdir($image_path);
    $image_path = $image_path . "/" . basename($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    $image->imageURL = $image_path;
    $image->file_size = $_FILES['image']['size'];
    $image->file_type = $_FILES['image']['type'];
}

// $temp_image = $_FILES['image'] ?? null;
//     var_dump($temp_image);
//     exit;
//     //If there is an image
//     $imagePath = 'images/' . $temp_image['name'];
//     if (!is_dir('images')) {
//         mkdir('images');
//     }
//    // mkdir(dirname($imagePath));
//     move_uploaded_file($temp_image['tmp_name'], $imagePath);

    $image->resolution = $_POST['resolution'];
     $image->GPS_coordinates = $_POST['GPS_coordinates'];
     $image->photographer = $_POST['photographer'];
     $image->location = $_POST['location'];
     $image->date = date('Y-m-d H:i:s');
     $image->camera = $_POST['camera'];

// $image->imageURL = $data->imageURL;
// $image->resolution = $data->resolution;
// $image->file_size = $data->file_size;
// $image->file_type = $data->file_type;
// $image->GPS_coordinates = $data->GPS_coordinates;
// $image->photographer = $data->photographer;
// $image->location = $data->location;
// $image->date = $data->date;
// $image->camera = $data->camera;

//Create the post
if($image->create()){
echo json_encode(
    array('message' => 'Post Created')
);
}else{
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
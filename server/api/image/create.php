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

//Check if theres an image
if(!empty($_FILES['image']))
  {
    $path = "../../images";
    if (!is_dir($path)) {
                 mkdir($path);
    }

    $image_path =  "/" .randomString(8);
    mkdir($path.$image_path);
   
    $image_path = $image_path . "/" . basename($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $path.$image_path);
    $image_file = $path.$image_path;
    
    //Set the data
    $image->imageURL = $image_path;
    $image->file_size = $_FILES['image']['size'];
    $image->file_type = $_FILES['image']['type'];
    $image->date = date('Y-m-d H:i:s');
   
    $exif_data = exif_read_data($path.$image_file);
    if(!($image->file_type === "image/png")){
        if($exif_data['DateTime']){
            $image->date = $exif_data['DateTime'];
        }
        if($exif_data['DateTimeOriginal']){
            $image->date = $exif_data['DateTimeOriginal'];
        }
        if($exif_data['Make']){
            $image->camera = $exif_data['Make'];
        }
        if($exif_data['Model']){
            $image->camera = $image->camera ." ". $exif_data['Model'];
        }
        if($exif_data['XResolution'] && $exif_data['YResolution']){
            $image->resolution =  $exif_data['XResolution']."x".$exif_data['YResolution'];
        }
        if($exif_data['GPSLatitudeRef'] && $exif_data['GPSLatitude']){
            $image->GPS_coordinates = $image->GPS_coordinates. $exif_data['GPSLatitudeRef'];
            foreach($exif_data['GPSLatitude'] as $value){
                $image->GPS_coordinates = $image->GPS_coordinates .";". $value;
            }
            $image->GPS_coordinates = $image->GPS_coordinates .";";
        }
        if($exif_data['GPSLongitudeRef'] && $exif_data['GPSLongitude']){
            $image->GPS_coordinates = $image->GPS_coordinates . $exif_data['GPSLongitudeRef'];
            foreach($exif_data['GPSLongitude'] as $value){
                $image->GPS_coordinates = $image->GPS_coordinates .";". $value;
            }
        }
        
    }
}

    //Sets attributes if they are available
   if (isset($_POST['resolution'])){
    $image->resolution = $_POST['resolution'];
   }  

   if (isset($_POST['location'])){
    $image->location = $_POST['location'];
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

   if (isset($_POST['limited_usage'])){
    $image->limited_usage = $_POST['limited_usage'];
   }

   if (isset($_POST['published'])){
    $image->published = $_POST['published'];
   }
   
   http_response_code(400);
//Create the post
if($image->create()){
    http_response_code(200);
echo json_encode(
    array('message' => 'Post Created')
);
}else{
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
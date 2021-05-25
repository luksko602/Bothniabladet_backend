<?php

//author: Lukas Skog Andersen
//A api to search for images with an array or single key.

//Headers, only POST allowed
header('Access-Control-Allow-Origin: *');
header('Content-Type: multipart/form-data');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once '../../functions/functions.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate image object
$image = new Image($db);

//Check if image is provided as POST data.
if(!empty($_FILES['image']))
  {
    $path = "../../images";
    //If the imagefolder is missing, create it
    if (!is_dir($path)) {
                 mkdir($path);
    }

    //Makes an unique random folder. Otherwise picture with the same name can overwrite eachother.
    $image_path =  "/" .randomString(8);
    mkdir($path.$image_path);
   
    //Sets the image path to the new folder
    $image_path = $image_path . "/" . basename($_FILES['image']['name']);

    //Moves the image to the new folder.
    move_uploaded_file($_FILES['image']['tmp_name'], $path.$image_path);
    $image_file = $path.$image_path;
    
    //Set the imagepath to the Image object.
    $image->imageURL = $image_path;
    //Retrieves data from the file, size and type.
    $image->file_size = $_FILES['image']['size'];
    $image->file_type = $_FILES['image']['type'];
    //Sets the date to current date (If any other date is provided it will be overwritten)
    $image->date = date('Y-m-d H:i:s');
   
    //Checks the image for exit data. If provided the properties are set.
    $exif_data = exif_read_data($path.$image_file);
    if(!($image->file_type === "image/png")){
        if($exif_data['DateTime']){
            //The date the image stored, overwrites previos dates
            $image->date = $exif_data['DateTime'];
        }
        if($exif_data['DateTimeOriginal']){
            //The date the image was taken, overwrites previos dates
            $image->date = $exif_data['DateTimeOriginal'];
        }
        if($exif_data['Make']){
            //The camera the picture was taken with
            $image->camera = $exif_data['Make'];
        }
        if($exif_data['Model']){
            //The model of the camera.
            $image->camera = $image->camera ." ". $exif_data['Model'];
        }
        if($exif_data['XResolution'] && $exif_data['YResolution']){
            //The resulution of the image in X and Y direction.
            $image->resolution =  $exif_data['XResolution']."x".$exif_data['YResolution'];
        }
        if($exif_data['GPSLatitudeRef'] && $exif_data['GPSLatitude']){
            //The GPS coordinates for the picure. Latitude.
            $image->GPS_coordinates = $image->GPS_coordinates. $exif_data['GPSLatitudeRef'];
            foreach($exif_data['GPSLatitude'] as $value){
                $image->GPS_coordinates = $image->GPS_coordinates .";". $value;
            }
            $image->GPS_coordinates = $image->GPS_coordinates .";";
        }
        if($exif_data['GPSLongitudeRef'] && $exif_data['GPSLongitude']){
            //The GPS coordinates for the picure. Longitude
            $image->GPS_coordinates = $image->GPS_coordinates . $exif_data['GPSLongitudeRef'];
            foreach($exif_data['GPSLongitude'] as $value){
                $image->GPS_coordinates = $image->GPS_coordinates .";". $value;
            }
        }
        
    }
}

    //If any properties are set as form data this will overwrite the exif-data
   if (isset($_POST['resolution'])){
    $image->resolution = $_POST['resolution'];
   }  

   if (isset($_POST['location'])){
       //Where is the picture taken
    $image->location = $_POST['location'];
   }
   
   if (isset($_POST['GPS_coordinates'])){
    $image->GPS_coordinates = $_POST['GPS_coordinates'];
   }
   
   if (isset($_POST['photographer'])){
       //Who took the picture
    $image->photographer = $_POST['photographer'];
   }

   if (isset($_POST['camera'])){
    $image->camera = $_POST['camera'];
   }

   if (isset($_POST['limited_usage'])){
    //If there are any limits to using the picture
    $image->limited_usage = $_POST['limited_usage'];
   }

   if (isset($_POST['published'])){
    //If the picture should be hidden from customer.
    $image->published = $_POST['published'];
   }
   
   //Sets the responsecode to failed (400)
   http_response_code(400);

   //Creates the post
    if($image->create()){
    //If succeeded, set the repsondecode to successfull (200)
    http_response_code(200);
    //Echo result
    echo json_encode(
        array('message' => 'Post Created')
    );
}else{
    //Echo that something went wrong.
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
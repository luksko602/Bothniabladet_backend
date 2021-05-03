<?php

class Image{
    //DB stuff
    private $conn;
    private $table = 'image';

       //Post Properties
       public $ID_image;
       public $imageURL;
       public $resolution;
       public $file_size;
       public $file_type;
       public $GPS_coordinates;
       public $photographer;
       public $location;
       public $date;
       public $camera;
   
       // Constructor with DB
       public function __construct($db) {
           $this->conn = $db;
       }

       //Get images
       public function read(){
        //Create query   
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        return $stmt;

        }
}
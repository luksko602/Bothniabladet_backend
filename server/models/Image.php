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

          //Get single image
    public function read_single(){
        //Create query
      //  $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera FROM ' 
       // . $this->table. 'WHERE ID_image = ?';
         
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera FROM '.
        $this->table .' WHERE ID_image = ?';
      
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->ID_image);

        //Execute statement
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        $this->ID_image = $row['ID_image'];
        $this->imageURL = $row['imageURL'];
        $this->resolution = $row['resolution'];
        $this->file_size = $row['file_size'];
        $this->file_type = $row['file_type'];
        $this->GPS_coordinates = $row['GPS_coordinates'];
        $this->photographer = $row['photographer'];
        $this->location = $row['location'];
        $this->date = $row['date'];
        $this->camera = $row['camera'];

        return $stmt; 
    }
}
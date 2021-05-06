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
       public $published;
       public $limited_usage;
   
       // Constructor with DB
       public function __construct($db) {
           $this->conn = $db;
       }

    //Get images
    public function read(){

        //Create query   
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera, limited_usage, published  FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        return $stmt;
        }

    //Get single image
    public function read_single(){
        //Create query
         
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera, limited_usage, published FROM '.
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
        $this->limited_usage =$row['limited_usage'];
        $this->published = $row['published'];

        return $stmt; 
    }
    //Create image
    public function create(){
        //Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            imageURL= :imageURL,
            resolution= :resolution,
            file_size= :file_size,
            file_type= :file_type, 
            GPS_coordinates= :GPS_coordinates,
            photographer= :photographer,
            location= :location,
            date= :date,
            camera= :camera';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->imageURL = htmlspecialchars(strip_tags($this->imageURL));
        $this->resolution = htmlspecialchars(strip_tags($this->resolution));
        $this->file_size = htmlspecialchars(strip_tags($this->file_size));
        $this->file_type = htmlspecialchars(strip_tags($this->file_type));
        $this->GPS_coordinates = htmlspecialchars(strip_tags($this->GPS_coordinates));
        $this->photographer = htmlspecialchars(strip_tags($this->photographer));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->camera = htmlspecialchars(strip_tags($this->camera));
  
        //Bind data
        $stmt->bindParam(':imageURL',  $this->imageURL);
        $stmt->bindParam(':resolution', $this->resolution);
        $stmt->bindParam(':file_size', $this->file_size);
        $stmt->bindParam(':file_type', $this->file_type);
        $stmt->bindParam(':GPS_coordinates', $this->GPS_coordinates);
        $stmt->bindParam(':photographer', $this->photographer);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':camera', $this->camera);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }else{
        //Print error if somethings wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
        }
    }

        //Search for images
       public function filter($keys){
        //Create query   
        if(empty($keys)){
            die();
        }
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera FROM ' . $this->table;
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera FROM '. $this->table .
        ' AS i
        INNER JOIN keyword_has_image AS khi  ON khi.Image_ID_image = i.ID_image
        INNER JOIN keyword AS k ON k.ID_keyword = khi.Key_word_ID_key_word
        WHERE k.keyword = "'. $keys['0'].'"';
        
        $keys_size = count($keys);
        if ($keys_size > 1){
            for($x = 1; $x <= $keys_size-1; $x++){
                     $query = $query . ' OR k.keyword = "' . $keys[$x].'"';
                 }         
        }
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        return $stmt;

        }
        
        
}
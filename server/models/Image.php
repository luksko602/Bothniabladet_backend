<?php

//author: Lukas Skog Andersen
//A data access object of a image in the database.

class Image{

    //DB connection and table
    private $conn;
    private $table = 'image';

       //Image Properties
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

    //Get all images fromt the database
    public function read(){

        //Create query   
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera, limited_usage, published  FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        //Return result
        return $stmt;
        }

    //Gets a singel image by its ID
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

        //Handle result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties in this object
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

        //Return resukt
        return $stmt; 
    }

    //Creates an image in the database
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
            camera= :camera,
            limited_usage= :limited_usage,
            published= :published';

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
        $this->limited_usage = htmlspecialchars(strip_tags($this->limited_usage));
        $this->published = htmlspecialchars(strip_tags($this->published));
  
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
        $stmt->bindParam(':limited_usage', $this->limited_usage);
        $stmt->bindParam(':published', $this->published);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }else{
        //Print error if somethings wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
        }
    }


        //Function which search for images with an array of keywords (or single word).
       public function filter($keys){
        //Makes sure there are keywords to search with
        if(empty($keys)){
            die();
        }
        
        //Prepares query with a double join to retrieves images with specific keywords in it.
        $query = 'SELECT ID_image, imageURL, resolution, file_size, file_type, GPS_coordinates, photographer, location, date, camera, limited_usage, published FROM '. $this->table .
        ' AS i
        INNER JOIN keyword_has_image AS khi  ON khi.Image_ID_image = i.ID_image
        INNER JOIN keyword AS k ON k.ID_keyword = khi.Key_word_ID_key_word
        WHERE k.keyword = "'. $keys['0'].'"';

        $keys_size = count($keys);
        //If there are more than one keywords to search for, this SQL statement is
        //added to the query.
        if ($keys_size > 1){
            for($x = 1; $x <= $keys_size-1; $x++){
                     $query = $query . ' OR k.keyword = "' . $keys[$x].'"';
                 }         
        }
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        //Return result
        return $stmt;
        }

        //Function to delete an image in the database based on its ID
        public function delete(){
            //Delete all keyword connections related to this picture
            if($this->deleteKeywords()){
            
            //Prepare statement to delete image
            $query = 'DELETE FROM '.$this->table.' WHERE ID_image = :id';
            $stmt = $this->conn->prepare($query);

            //Clean and bind value
            $this->ID_image = htmlspecialchars(strip_tags($this->ID_image));
            $stmt->bindValue(':id', $this->ID_image);
        
            //Execute
            if($stmt->execute()){
                return true;
            }else{
            //Print error if somethings wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }
        else{
            //Print error if somethings wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }

        //Deletes all keyword-connections related to this picture object.
        public function deleteKeywords(){
            //Prepare statement
            $query = 'DELETE FROM keyword_has_image WHERE Image_ID_image = :id';
            $stmt = $this->conn->prepare($query);

            //Clean and bind value
            $this->ID_image = htmlspecialchars(strip_tags($this->ID_image));
            $stmt->bindValue(':id', $this->ID_image);
            
            //Execute
            if($stmt->execute()){
                return true;
            }else{
            //Print error if somethings wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }

        //Updates properties of the image.
        public function update(){
        //Prepare query
        $query = 'UPDATE '.$this->table.' SET 
            resolution= :resolution,
            file_size= :file_size,
            file_type= :file_type, 
            GPS_coordinates= :GPS_coordinates,
            photographer= :photographer,
            location= :location,
            date= :date,
            camera= :camera,
            limited_usage= :limited_usage,
            published= :published 
            WHERE (ID_image = :ID_image)';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->resolution = htmlspecialchars(strip_tags($this->resolution));
        $this->file_size = htmlspecialchars(strip_tags($this->file_size));
        $this->file_type = htmlspecialchars(strip_tags($this->file_type));
        $this->GPS_coordinates = htmlspecialchars(strip_tags($this->GPS_coordinates));
        $this->photographer = htmlspecialchars(strip_tags($this->photographer));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->camera = htmlspecialchars(strip_tags($this->camera));
        $this->limited_usage = htmlspecialchars(strip_tags($this->limited_usage));
        $this->published = htmlspecialchars(strip_tags($this->published));
        $this->ID_image = htmlspecialchars(strip_tags($this->ID_image));
  
        //Bind data
        $stmt->bindParam(':resolution', $this->resolution);
        $stmt->bindParam(':file_size', $this->file_size);
        $stmt->bindParam(':file_type', $this->file_type);
        $stmt->bindParam(':GPS_coordinates', $this->GPS_coordinates);
        $stmt->bindParam(':photographer', $this->photographer);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':camera', $this->camera);
        $stmt->bindParam(':limited_usage', $this->limited_usage);
        $stmt->bindParam(':published', $this->published);
        $stmt->bindParam(':ID_image', $this->ID_image);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }else{
        //Print error if somethings wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
        }
        }       
}
<?php

//author: Lukas Skog Andersen
//A data access object of a keyword in the database.

class Keyword{
    //DB connection and current table.
    private $conn;
    private $table = 'keyword';

       //keyword properties
       public $ID_keyword;
       public $keyword;

       // Constructor with DB
       public function __construct($db) {
           $this->conn = $db;
       }

    //Return all keywords in the database.
    public function read(){

        //Create query   
        $query = 'SELECT ID_keyword, keyword FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        //Return result
        return $stmt;
        }

        //Creates a new keyword in the database.
        public function create(){
            //Create query
            $query = "INSERT INTO ".$this->table."(".$this->table.") SELECT '".$this->keyword."' 
            WHERE NOT EXISTS (SELECT * FROM ". $this->table ." WHERE ".$this->table."='".$this->keyword."')";
    
            //Prepare statement
            $stmt = $this->conn->prepare($query);
    
            //Clean data
            $this->keyword = htmlspecialchars(strip_tags($this->keyword));
      
            //Execute query
            if($stmt->execute()){
                //Returns true if succeeded
                return true;
            }else{
            //Print error if somethings wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }

        //Creates a connection between an image and a keyword.
        public function image_connect($ID_image){
            //Calls a function to check if the keyword is in the database.
            if(!$this->keyword_exists($this->keyword)){
                if($this->create()){
                    //If not, it creates it.
                    echo json_encode(
                        array('message' => 'Keyword '.$this->keyword.' Created')
                    );
                }else{
                    echo json_encode(
                        array('message' => 'Keyword not created')
                    );
                }
            }

        //Create query for inserting connection.
            $query = 'INSERT INTO keyword_has_image (Key_word_ID_key_word, Image_ID_image) 
            VALUES ((SELECT ID_keyword from keyword WHERE keyword="'.$this->keyword.'"), '.$ID_image.')';
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);   

        //Clean data
        $ID_image = htmlspecialchars(strip_tags($ID_image));
        $this->keyword = htmlspecialchars(strip_tags($this->keyword));

        //Execute query
        if($stmt->execute()){
            return true;
        }else{
        //Print error if somethings wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
        }
    }
    
    //Function which checks whether a keywords exists in the database or not.
    public function keyword_exists($key){
        //Create query   
        $query = 'SELECT keyword FROM ' . $this->table.' WHERE keyword = "' .$key.'"';
            
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        try{
            $stmt->execute();
            $num = $stmt->rowCount();
            //Check if any posts
            if($num > 0){
                //If the keywords exists -> return true
                return true;
            }else{
                //If the keywords does not exists -> return false
                return false;
            }
        }catch(Exception $e){
            //If any troubles -> return false
            return false;
        }
    }

    //Retrieves all keywords from a specific image by its ID
    public function read_by_id_image($ID_image){
        //Creates a query with a join on keyword.
        $query = 'SELECT keyword FROM keyword_has_image as khi 
        JOIN keyword as k ON khi.Key_word_ID_key_word = k.ID_keyword 
        WHERE khi.Image_ID_image = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean and bind data
        $ID_image = htmlspecialchars(strip_tags($ID_image));
        $stmt->bindValue(':id', $ID_image);

        //Execute and return statement
        $stmt->execute();
         return $stmt;
 }
}
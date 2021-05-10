<?php

class Keyword{
    //DB stuff
    private $conn;
    private $table = 'keyword';

       //Post Properties
       public $ID_keyword;
       public $keyword;

       // Constructor with DB
       public function __construct($db) {
           $this->conn = $db;
       }

    //Get keywords
    public function read(){

        //Create query   
        $query = 'SELECT ID_keyword, keyword FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        return $stmt;
        }

        //Create keyword
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
                return true;
            }else{
            //Print error if somethings wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }

        //Create a connection between an image and a keyword
        public function image_connect($ID_image){
            if(!$this->keyword_exists($this->keyword)){
                if($this->create()){
                    echo json_encode(
                        array('message' => 'Keyword '.$this->keyword.' Created')
                    );
                }else{
                    echo json_encode(
                        array('message' => 'Keyword not created')
                    );
                }
            }
        //Create query
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
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}
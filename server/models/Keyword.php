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
            $this->imageURL = htmlspecialchars(strip_tags($this->keyword));
      
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
<?php

//author: Lukas Skog Andersen
//A data access object of a Member in the database

class Member{
    //DB connection and table
    private $conn;
    private $table = 'member';

    //Member Properties
    public $ID_member;
    public $password;
    public $first_name;
    public $last_name;
    public $city;
    public $postal;
    public $street;
    public $phone;
    public $email;
    public $discount_amount;
    public $member_type;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get information about all  members in the database
    public function read(){
        //Create query
        $query = 'SELECT ID_member, password, first_name, last_name, city, postal, street, phone, email, discount_amount, member_type FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        //Return statement
        return $stmt;
    }

    //Get a single member from the database based on its ID
    public function read_single(){
        //Create query
        $query = 'SELECT ID_member, password, first_name, last_name, city, postal, street, phone, email, discount_amount, member_type FROM ' 
        . $this->table . ' WHERE ID_member = ?';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->ID_member);

        //Execute statement
        $stmt->execute();

        //Handle result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties in this object
        $this->ID_member = $row['ID_member'];
        $this->password = $row['password'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->city = $row['city'];
        $this->postal = $row['postal'];
        $this->street = $row['street'];
        $this->phone = $row['phone'];
        $this->email = $row['email'];
        $this->discount_amount = $row['discount_amount'];
        $this->member_type = $row['member_type'];

        //Return statement
        return $stmt; 
    }

    //Create a member based on post data.
    public function create(){
        //Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            password= :password,
            first_name= :first_name,
            last_name= :last_name,
            city= :city, 
            postal= :postal,
            street= :street,
            phone= :phone,
            email= :email,
            discount_amount= :discount_amount,
            member_type= :member_type';
       
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->postal = htmlspecialchars(strip_tags($this->postal));
        $this->street = htmlspecialchars(strip_tags($this->street));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->discount_amount = htmlspecialchars(strip_tags($this->discount_amount));
        $this->member_type = htmlspecialchars(strip_tags($this->member_type));

        //Bind data, done to prevent SQL-injections
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':postal', $this->postal);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':member_type', $this->member_type);
        $stmt->bindParam(':discount_amount', $this->discount_amount);

        //Execute query
        if($stmt->execute()){
            //Return true if everything went okay.
            return true;
        }else{
        //Print error if somethings wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
        }
    }

    //Function which simulates a login. Returns true if login successful, otherwise false
    function login(){
        //Create query
        $query = "SELECT email, password, member_type, ID_member from ". $this->table ." where email = '" . $this->email . "' AND password = '" . $this->password . "'";
  
        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        //Return result
        return $stmt;
    }
}
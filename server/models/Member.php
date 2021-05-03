<?php

class Member{
    //DB stuff
    private $conn;
    private $table = 'member';

    //Post Properties
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

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get members
    public function read(){
        //Create query
        $query = 'SELECT ID_member, password, first_name, last_name, city, postal, street, phone, email, discount_amount FROM ' . $this->table;
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute statement
        $stmt->execute();

        return $stmt;
    }
}
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

    //Get single member
    public function read_single(){
        //Create query
        $query = 'SELECT ID_member, password, first_name, last_name, city, postal, street, phone, email, discount_amount FROM ' 
        . $this->table . ' WHERE ID_member = ?';
                
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->ID_member);

        //Execute statement
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
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

        return $stmt; 
    }

    //Create member
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
            email= :email';
        // INSERT INTO `bothniabladet`.`member` (`password`, `first_name`, `last_name`, `city`, `postal`, `street`, `phone`, `email`) VALUES ('hej', 'Kalle', 'Karlsson', 'Stad', '12312', 'Gatan 1', '013-122312', 'kalle.karlsson@hotmail.com');
        
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

        //Bind data
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':postal', $this->postal);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);

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
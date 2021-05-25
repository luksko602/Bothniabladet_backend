<?php
//author: Lukas Skog Andersen
//A database class which handle the connection.
class Database
{
    //DB parameters
    private $host = 'localhost';
    private $db_name = 'bothniabladet';
    private $username = 'root';
    private $password = '';
    private $conn;

    //Creates a database connecition
    public function connect()
    {
        $this->conn = null;
        try {
            //Tries to connect
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            //Sets the errormode and exceptionmode
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //If something went wrong
            echo 'Connection Error: ' . $e->getMessage();
        }
        //Returns the connection
        return $this->conn;
    }
}

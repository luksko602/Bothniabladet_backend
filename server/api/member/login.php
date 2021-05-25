<?php

//author: Lukas Skog Andersen
//A api to login as a member in the database

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Member.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate member object
$member = new Member($db);

//Makes sure that email and password is set as params
$member->email = isset($_GET['email']) ? $_GET['email'] : die();
$member->password = isset($_GET['password']) ? $_GET['password'] : die();

//Try to login
$stmt = $member->login();

//Check if login was successful
if($stmt->rowCount() > 0){
    //Get the row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //Create array if login was successful
    $login_arr = array(
        "status" => true,
        "message" => "Successful login!",
        "email" => $row['email'],
        "member_type" => $row['member_type'],
        "ID_member" => $row['ID_member']
    );
}else{
    //If login did not work
    $login_arr = array(
        "status" => false,
        "message" => "Invalid Username or Password."
    );
}
    //echo result
    echo json_encode($login_arr);

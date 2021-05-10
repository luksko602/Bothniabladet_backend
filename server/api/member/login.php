<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Member.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate member object
$member = new Member($db);

$member->email = isset($_GET['email']) ? $_GET['email'] : die();
$member->password = isset($_GET['password']) ? $_GET['password'] : die();

$stmt = $member->login();

if($stmt->rowCount() > 0){
    //Get the row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //Create array
    $login_arr = array(
        "status" => true,
        "message" => "Successful login!",
        "email" => $row['email']
    );
}else{
    $login_arr = array(
        "status" => false,
        "message" => "Invalid Username or Password."
    );
}
    echo json_encode($login_arr);

<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Member.php';

//Instantiate DB & connect
$database = new Database();
$db = $database -> connect();

//Instantiate blog post object
$member = new Member($db);

//Member query
$result = $member->read();
//Get row count
$num = $result->rowCount();

//Check if any posts
if($num > 0){
    //Member array
    $members_arr = array();
    $members_arr['data'] = array ();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $member_item = array(
            'ID_member' => $ID_member,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'city' => $city,
            'postal' => $postal,
            'street' => $street,
            'phone' => $phone,
            'email' => $email,
            'discount_amount' => $discount_amount
        );
        
        //Push to "data"
        array_push($members_arr['data'], $member_item);
    }

    //Turn to JSON & output
    echo json_encode($members_arr);
}else{
    //No members
    echo json_encode(
        array('message' => 'No members found')
    );
}
<?php

//author: Lukas Skog Andersen
//A api to read a single member in the database

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

//Get ID from params, make sure it is set
$member->ID_member = isset($_GET['id']) ? $_GET['id'] : die();

//Get single member
$member->read_single();

//Create array
$member_arr = array(
    'ID_member' => $member->ID_member,
    'password' => $member->password,
    'first_name' => $member->first_name,
    'last_name' => $member->last_name,
    'city' => $member->city,
    'postal' => $member->postal,
    'street' => $member->street,
    'phone' => $member->phone,
    'email' => $member->email,
    'discount_amount' => $member->discount_amount,
    'member_type' => $member->member_type
);

//return reuslt as json
print_r(json_encode($member_arr));

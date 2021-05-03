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

//Get ID
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
    'memberal' => $member->postal,
    'street' => $member->street,
    'phone' => $member->phone,
    'email' => $member->email,
    'discount_amount' => $member->discount_amount,
);

//Make JSON
print_r(json_encode($member_arr));

<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));


$user_id = $data->user_id;
$pro_id = $data->pro_id;
$fname = $data->fname;
$address = $data->address;
$city = $data->city;
$state = $data->state;
$pincode = $data->pincode;
$phoneno = $data->phoneno;
$email = $data->email;

$pincode_format = "^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$^";
$phoneno_format = '/^[0-9]{10}$/';
$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";

if($user_id == "" || $pro_id == "" || $fname == "" || $address == "" || $city == "" || $state == "" || $pincode == "" || $phoneno == "" || $email == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));    
}

if (!preg_match($pincode_format, $pincode))
{
    http_response_code(403);
    die(json_encode(["message" => "Invalid Pincode"]));
}
if(!preg_match($phoneno_format, $phoneno))
{
    http_response_code(403);
    die(json_encode(["message" => "Invalid Phone No."]));
}
if(!preg_match($email_format, $email)) 
{
    http_response_code(403);
    die(json_encode(["message" => "Invalid email address."]));
}

$query = "SELECT * FROM addressdetails WHERE user_id = ?";
$params = [$user_id];
$response = select($query, $params);

$query = "UPDATE addressdetails SET pro_id=?, name=?, address=?, city=?, state=?, pincode=?, phoneno=?, email=? WHERE user_id=?";
$params = [$pro_id, $fname, $address, $city, $state, $pincode, $phoneno, $email, $user_id];
execute($query, $params);


die(json_encode(["message" => "Address Registered Successfully."]));

echo json_encode($response);
?>


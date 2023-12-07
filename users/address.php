<?php
include_once '../users/address.php';

$data = json_decode(file_get_contents('php://input'));

$userId = $data->userId;
$proId = $data->proId;
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

if ($userId == "" || $proId == "" || $fname == "" || $address == "" || $city == "" || $state == "" || $pincode == "" || $phoneno == "" || $email == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
} else if(!preg_match($pincode_format, $pincode)){
    http_response_code(403);
    $response = ["msg" => "Invalid Pincode"];
} else if(!preg_match($phoneno_format, $phoneno)){
    http_response_code(403);
    $response = ["msg" => "Invalid Phone Number"];
} else if (!preg_match($email_format, $email)) {
    http_response_code(403);
    $response = ["msg" => "Invalid email address."];
}
else
{
    $query = "INSERT INTO addressdetails(user_id,pro_id,name,address,city,state,pincode,phoneno,email) VALUES('$userId','$proId','$fname','$address','$city','$state','$pincode','$phoneno','$email')";
    $params = [$userId,$proId,$fname, $address, $city, $state,$pincode,$phoneno,$email];
    
    execute($query, $params);
    $response = ["msg" => "Address Register Successfully.!"];
}

echo json_encode($response)
?>
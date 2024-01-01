<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$email = $data->email;
$password = $data->password;

$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";

if ($email == "" || $password == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}
if (!preg_match($email_format, $email)) 
{
    http_response_code(403);
    die(json_encode(["message" => "Wrong Username Or Password"]));
}

$query = "SELECT id,email,usertype FROM users WHERE email = ? and password = ? and usertype = ?";
$params = [$email, $password, "user"];

$response = selectOne($query, $params);

if (!$response) 
{
    http_response_code(403);
    die(json_encode(["message" => "Wrong Username Or Password"]));
}

echo json_encode($response)
?>
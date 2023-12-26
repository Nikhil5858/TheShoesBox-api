<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$email = $data->email;
$password = $data->password;

if ($email == "" || $password == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}

$query = "SELECT id,name FROM users WHERE email = ? and password = ? and usertype = ?";
$params = [$email, $password, "admin"];

$response = selectOne($query, $params);

if (!$response) 
{
    http_response_code(403);
    die(json_encode(["message" => "Wrong Username Or Password"]));
}


echo json_encode($response)
?>
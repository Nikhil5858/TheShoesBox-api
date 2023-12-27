<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$email = $data->email;
$phoneno = isset($data->phoneno) ? $data->phoneno : null;
$password = $data->password;
$confirmpassword = $data->confirmpassword;

$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";

if ($name == "" || $email == "" || $password == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}
if ($password !== $confirmpassword) 
{
    http_response_code(403);
    die(json_encode(["message" => "Passwords do not match!"]));
}
if (!preg_match($email_format, $email)) 
{
    http_response_code(403);
    die(json_encode(["message" => "Invalid email address."]));
}

$query = "SELECT * FROM users WHERE email = ?";
$params = [$email];
$response = selectOne($query, $params);

if ($response != "")
{
    http_response_code(403);
    die(json_encode(["message" => "User already Exits. Please choose a different user."]));
}

$query = "INSERT INTO users (name, email, phoneno, password) VALUES (?, ?, ?, ?)";
$params = [$name, $email, $phoneno, $password];

$response = execute($query, $params);
die(json_encode(["message" => "User added!"]));

echo json_encode($response)
?>
<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$email = $data->email;
$phoneno = $data->phoneno;
$password = $data->password;
$confirmpassword = $data->confirmpassword;

$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";

if ($name == "" || $email == "" || $password == "" || $phoneno == "") 
{
    http_response_code(403);
    die(json_encode(["msg" => "Fill All Fields"]));
}
if ($password !== $confirmpassword) 
{
    http_response_code(403);
    die(json_encode(["msg" => "Passwords do not match!"]));
}
if (!preg_match($email_format, $email)) 
{
    http_response_code(403);
    die(json_encode(["msg" => "Invalid email address."]));
}

$query = "SELECT * FROM users WHERE email = ?";
$params = [$email];
$result = selectOne($query, $params);

if ($result != "")
{
    http_response_code(403);
    die(json_encode(["msg" => "User already Exits. Please choose a different user."]));
} 
else 
{
    $query = "INSERT INTO users (name,email,phoneno,password) VALUES(?,?,?,?)";
    $params = [$name, $email, $phoneno, $password];
    
    execute($query, $params);
    die(json_encode(["msg" => "User added!"]));
}

echo json_encode($result)
?>
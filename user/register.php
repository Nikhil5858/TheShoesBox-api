<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$email = $data->email;
$phoneno = $data->phoneno;
$password = $data->password;
$confirmpassword = $data->confirmpassword;

$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";

if ($name == "" || $email == "" || $password == "" || $phoneno == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
} else if ($password !== $confirmpassword) {
    http_response_code(403);
    $response = ["msg" => "Passwords do not match!"];
} else if (!preg_match($email_format, $email)) {
    http_response_code(403);
    $response = ["msg" => "Invalid email address."];
}
else 
{
    $query = "SELECT * FROM users WHERE email = ?";
    $params = [$email];
    $result = selectOne($query, $params);
    
    if ($result != "") {
        http_response_code(403);
        $response = ["msg" => "User already Exits. Please choose a different user."];
    } else {
        $query = "INSERT INTO users (name,email,phoneno,password) VALUES(?,?,?,?)";
        $params = [$name, $email, $phoneno, $password];
        
        execute($query, $params);
        $response = ["msg" => "User added!"];
    }
}

echo json_encode($response)
?>
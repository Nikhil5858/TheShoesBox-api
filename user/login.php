<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$email = $data->email;
$password = $data->password;

if ($email == "" || $password == "") 
{
    http_response_code(403);
    die(json_encode(["msg" => "Fill All Fields"]));
}
else 
{
    $query = "SELECT id,email,usertype FROM users WHERE email = ? and password = ? and usertype = ?";
    $params = [$email, $password, "user"];
    
    $result = selectOne($query, $params);

    if (!$result) 
    {
        http_response_code(403);
        die(json_encode(["msg" => "Wrong Username Or Password"]));
    }
}

echo json_encode($result)
?>
<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$email = $data->email;
$password = $data->password;

if ($email == "" || $password == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
} else {
    $query = "SELECT id,name FROM users WHERE email = ? and password = ? and usertype = ?";
    $params = [$email, $password, "user"];
    
    $result = selectOne($query, $params);
    
    if ($result == "") {
        http_response_code(403);
        $response = ["msg" => "Wrong Username Or Password"];
    } else {
        $response = ["msg" => "Success"];
    }
}

echo json_encode($response)
?>
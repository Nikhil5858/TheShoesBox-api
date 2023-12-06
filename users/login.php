<?php
include_once '../database/database.php';

$data = file_get_contents('php://input');
$json = json_decode($data);

$email = $json->email;
$password = $json->password;

if ($email == "" || $password == "") {
    $response = ["msg" => "Fill All Fields"];
} else {
    $query = "SELECT id,name FROM users WHERE email = ? and password = ? and usertype = ?";
    $params = [$email, $password, "user"];

    $result = selectOne($query, $params);

    if ($result == "") {
        $response = ["msg" => "Wrong Username Or Password"];
    } else {
        $response = ["msg" => "Success"];
    }
}

echo json_encode(["" => true, "msg" => "Registration successful"])
?>
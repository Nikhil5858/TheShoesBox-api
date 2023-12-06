<?php
include_once '../database/database.php';

$data = file_get_contents('php://input');
$json = json_decode($data);

$username = $json->username;
$email = $json->email;
$password = $json->password;
$confirmpassword = $json->confirmpassword;

if ($username == "" || $email == "" || $password == "" || $confirmpassword == "") {
    $response = ["msg" => "Fill All Fields"];}

$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";
if (!preg_match($email_format, $email)) {
    $response = ["msg" => "Invalid email address."];
}

$query = "SELECT * FROM users WHERE email = ?";
$params = [$username, $email, $password, $confirmpassword];
$result = selectOne($query, $params);

if ($result->num_rows > 0) {
        $response = ["msg" => "User already Exits. Please choose a different user."];
}

if ($password !== $confirmpassword) {
    $response = ["msg" => "Passwords do not match!"];
}

echo json_encode($response)
?>
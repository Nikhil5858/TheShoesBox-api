<?php

$data = post();

$email = $data->email;
$password = $data->password;

if ($email == "" || $password == "")
    error(403, "Fill all fields!");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    error(403, "Enter valid email!");

$query = "SELECT id, usertype FROM users WHERE email = ? AND password = ?";
$params = [$email, $password];

$response = selectOne($query, $params);

if (!$response)
    error(403, "Wrong Username Or Password");

reply([
    "id" => $response["id"],
    "usertype" => $response["usertype"]
]);
<?php

$data = post();

$name = $data->name;
$email = $data->email;
$password = $data->password;
$confirmpassword = $data->confirmPassword;

if ($name == "" || $email == "" || $password == "")
error(403, "Fill All Fields");

if ($password != $confirmpassword)
error(403, "Passwords do not match!");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
error(403, "Invalid email address.");

$response = selectOne("SELECT * FROM users WHERE email = ?", [$email]);

if ($response != "")
error(403, "User already taken.");

$query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$params = [$name, $email, $password];

execute($query, $params);
$user_id = lastInsertId();

reply([
    "id" => $user_id
]);
<?php

$data = post();

$user_id = $data->user_id;
$name = $data->name;
$email = $data->email;
$phoneno = $data->phoneno;

$phoneno_format = '/^[0-9]{10}$/';

if ($name == "" || $email == "" || $phoneno == "")
    error(403, "Fill All Fields");
 
if(!preg_match($phoneno_format, $phoneno))
    error(400,"Invalid Phoneno");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
error(403, "Invalid email address.");

$query = "UPDATE users SET name=?,email=?,phoneno=? WHERE id=?";
$params = [$name,$email,$phoneno,$user_id];
$response = selectOne($query,$params);

success("Profile Updated Successfully.");

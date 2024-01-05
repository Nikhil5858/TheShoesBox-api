<?php

$data = post();

$user_id = $data->user_id;
$address = $data->address;
$city = $data->city;
$state = $data->state;
$pincode = $data->pincode;
$phoneno = $data->phoneno;
$email = $data->email;

$pincode_format = "^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$^";
$phoneno_format = '/^[0-9]{10}$/';

if($user_id == "" || $address == "" || $city == "" || $state == "" || $pincode == "" || $phoneno == "" || $email == "")
    error(400,"Fill All Fields");

if (!preg_match($pincode_format, $pincode))
    error(400,"Invalid Pincode");

if(!preg_match($phoneno_format, $phoneno))
    error(400,"Invalid Phoneno");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    error(403, "Invalid email address.");

$query = "SELECT * FROM addressdetails WHERE user_id = ?";
$params = [$user_id];
$response = select($query, $params);

$query = "UPDATE addressdetails SET address=?, city=?, state=?, pincode=?, phoneno=?, email=? WHERE user_id=?";
$params = [$address, $city, $state, $pincode, $phoneno, $email, $user_id];
execute($query, $params);

success("Address Registered Successfully.");


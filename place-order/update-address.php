<?php

$data = post();

$user_id = $data->user_id;
$address = $data->address;
$city = $data->city;
$state = $data->state;
$pincode = $data->pincode;
$phoneno = $data->phoneno;
$email = $data->email;


if ($user_id == "" || $address == "" || $city == "" || $state == "" || $pincode == "" || $phoneno == "" || $email == "")
    error(400, "Fill All Fields");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    error(403, "Invalid email address.");

$phoneno_format = '/^[0-9]{10}$/';
if (!preg_match($phoneno_format, $phoneno))
    error(400, "Invalid Phoneno");

$state_formate = "/^[A-Za-z]+$/";
if (!preg_match($state_formate, $state))
    error(400, "Invalid State Name");

if (!preg_match($state_formate, $city))
    error(400, "Invalid City Name");

$pincode_format = "/^\d{6}$/";
if (!preg_match($pincode_format, $pincode))
    error(400, "Invalid Pincode");

$query = "SELECT * FROM addressdetails WHERE user_id = ?";
$params = [$user_id];
$response = select($query, $params);

$query = "UPDATE addressdetails SET address=?, city=?, state=?, pincode=?, phoneno=?, email=? WHERE user_id=?";
$params = [$address, $city, $state, $pincode, $phoneno, $email, $user_id];
execute($query, $params);

success("Address Registered Successfully.");

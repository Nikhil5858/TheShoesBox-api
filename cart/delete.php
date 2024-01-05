<?php

$data = post();

$product_id = $data->product_id;
$user_id = $data->user_id;

if ($product_id == "" || $user_id == "") 
    error(403, "Fill All Fields");

$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$params = [$user_id, $product_id];
$response = execute($query, $params);

if ($response == "") 
    reply($response);

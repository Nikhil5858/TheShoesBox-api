<?php

$data = post();

$id = $data->cartId;
// $user_id = $data->user_id;

if ($id == "") 
    error(403, "Fill All Fields");

$query = "DELETE FROM cart WHERE  id = ?";
$params = [$id];
$response = execute($query, $params);

if ($response == "") 
    reply($response);

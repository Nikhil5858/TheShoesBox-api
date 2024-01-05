<?php

$data = post();

$user_id = $data->user_id;
$product_id = $data->product_id;
$address_id = $data->address_id;
$rate = $data->rate; 
$pro_size = $data->pro_size; 
$quantity = $data->quantity;
$totalprice = $data->totalprice;

if ($user_id == "" || $product_id == "" || $address_id == "" || $rate == "" || $pro_size == "" || $quantity == "" || $totalprice == "") 
    error(400,"Fill All Fields");

$query = "INSERT INTO `order` (user_id, product_id, address_id, rate, pro_size, quantity, totalprice) VALUES (?, ?, ?, ?, ?, ?, ?)";
$params = [$user_id, $product_id, $address_id, $rate, $pro_size, $quantity, $totalprice];
execute($query, $params);

$query = "DELETE FROM cart WHERE user_id=? AND product_id=?";
$params = [$user_id,$product_id];
execute($query,$params);

success("Your Order is successfully added");


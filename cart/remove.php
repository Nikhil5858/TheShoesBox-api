<?php
$data = post();

$product_id = $data->product_id;
$user_id = $data->user_id;

if ($product_id == "" || $user_id == "")
    error(400);

$query = "SELECT * FROM cart WHERE user_id = ? and product_id = ?";
$params = [$user_id, $product_id];
$response = selectOne($query, $params);


$cartId =  $response["id"];
$productQuantity = $response["quantity"];

$newProductQuantity = $productQuantity - 1;

execute("UPDATE cart SET quantity = ? WHERE id = ?", [$newProductQuantity, $cartId]);

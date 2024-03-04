<?php
$data = post();

$cart_Id = $data->cart_Id;
// $user_id = $data->user_id;

if ($cart_Id == "")
    error(400);

$query = "SELECT * FROM cart WHERE id = ?";
$params = [$cart_Id];
$response = selectOne($query, $params);


$cartId =  $response["id"];
$productQuantity = $response["quantity"];

if($productQuantity > 1){
    
    $newProductQuantity = $productQuantity - 1;    
    execute("UPDATE cart SET quantity = ? WHERE id = ?", [$newProductQuantity, $cartId]);
}


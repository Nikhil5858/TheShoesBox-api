<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$user_id = $data->user_id;
$product_id = $data->product_id;
$address_id = $data->address_id;
$rate = $data->rate; 
$pro_size = $data->pro_size; 
$quantity = $data->quantity;
$totalprice = $data->totalprice;
$status = $data->status; 

if ($user_id == "" || $product_id == "" || $address_id == "" || $rate == "" || $pro_size == "" || $quantity == "" || $totalprice == "") {
    http_response_code(403);
    $response = ["msg" => "Looks like you missed some fields. Please check and try again"];
} else {
    $query = "INSERT INTO `order` (user_id, product_id, address_id, rate, pro_size, quantity, totalprice, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$user_id, $product_id, $address_id, $rate, $pro_size, $quantity, $totalprice, $status];

    execute($query, $params);
    $response = ["msg" => "Your Order is successfully added"];
}

echo json_encode($response);
?>

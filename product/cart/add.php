<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$productId = $data->productId;
$userId = $data->userId;
$quantity = $data->quantity;

if ($productId == "" || $userId == "" || $quantity == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
} 

$query = "SELECT * FROM cart WHERE user_id = ? and product_id = ?";
$params = [$userId, $productId];
$result = selectOne($query, $params);


if ($result && is_array($result) && count($result) > 0) {
    http_response_code(403);
    die(json_encode(["message" => "Product already in the cart. Please choose a different product."]));
} 

$query = "INSERT INTO cart (user_id, product_id,quantity) VALUES (?, ?, ?)";
$params = [$userId, $productId,$quantity];

$insertResult = execute($query, $params);

if ($insertResult) 
{
    die(json_encode(["message" => "Product added successfully"]));
} 

echo json_encode($response);
?>

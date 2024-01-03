<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$productId = $data->productId;
$userId = $data->userId;

if ($productId == "" || $userId == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}

$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$params = [$userId, $productId];

$deleteResult = execute($query, $params);

if ($deleteResult) 
{
    die(json_encode(["message" => "Product deleted successfully"]));
}

echo json_encode($response);
?>

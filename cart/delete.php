<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$product_id = $data->product_id;
$user_id = $data->user_id;

if ($product_id == "" || $user_id == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}

$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$params = [$user_id, $product_id];

$deleteResult = execute($query, $params);

if ($deleteResult) 
{
    die(json_encode(["message" => "Product deleted successfully"]));
}

echo json_encode($response);
?>

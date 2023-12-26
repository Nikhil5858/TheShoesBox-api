<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$id = $data->id;

if ($id == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
} 

$cartQuery = "DELETE FROM cart WHERE product_id=?";
$cartParams = [$id];
execute($cartQuery, $cartParams);

$productQuery = "DELETE FROM product WHERE id=?";
$productParams = [$id];
execute($productQuery, $productParams);

die(json_encode(["message" => "Product Deleted Successfully"]));

echo json_encode($response);
?>

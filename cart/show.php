<?php
include_once '../database/database.php';
$data = json_decode(file_get_contents('php://input'));

$user_id = $data->user_id;

$query = "SELECT 
            product.id, product.name, product.price, product.pro_img
        FROM 
            product
        INNER JOIN 
            cart 
        ON 
            product.id = cart.product_id
        WHERE 
            cart.user_id = ?";

$params = [$user_id];


$response = select($query, $params);
if ($response == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Data Not Found"]));
}

echo json_encode($response);
?>
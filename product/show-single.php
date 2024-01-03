<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$pro_id = $data->pro_id;

$query = "SELECT 
            brand.name 
        as 
            bname,product.id,product.name,product.price,product.pro_img,product.pro_details 
        FROM 
            brand,product 
        WHERE 
            brand.id=product.brand_id 
        and 
            product.id = ?";
            
$params = [$pro_id];

$response = selectOne($query,$params);


if ($response == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Data Not Found"]));
}

echo json_encode($response)
?>
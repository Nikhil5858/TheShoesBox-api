<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$query = "SELECT 
            brand.name 
        as 
            bname,product.id,product.name,product.price,product.pro_img 
        FROM 
            brand,product 
        where 
            brand.id=product.brand_id 
        ORDER BY 
            product.id 
        DESC";
$response = select($query);


if ($query == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Data Not Found"]));
}


echo json_encode($response)
?>
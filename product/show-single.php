<?php

$data = post();

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

if(!$response)
    error(403, "Product Not Found.");

reply([
    "user_id" => $response
]);
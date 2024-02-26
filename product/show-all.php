<?php

$data = post();

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


if (!$response)
    error(403, "Product Not Found.");

reply($response);

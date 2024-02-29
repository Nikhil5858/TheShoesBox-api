<?php

$user_id = $_GET['user_id'];

$query = "SELECT 
            cart.user_id, cart.id AS cartId,cart.quantity, product.id, product.name, product.price, product.pro_img
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

if (!$response) {
    error(403, "Data Not Found");
}

reply($response);

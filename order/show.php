<?php

$data = post();

$user_id = $data->user_id;

$query = "SELECT o.*, p.name AS product_name, p.pro_img AS pro_img, u.name AS user_name FROM `order` o
        LEFT JOIN users u ON o.user_id = u.id
        LEFT JOIN product p ON o.product_id = p.id
        WHERE o.user_id ='$user_id' ORDER BY o.id desc";

$response = select($query);

if (!$response)
    error(403, "Product Not Found.");

reply([
    "user_id" => $response
]);

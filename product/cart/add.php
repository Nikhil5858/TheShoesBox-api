<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$productId = $data->productId;
$userId = $data->userId;
$quantity = $data->quantity;

if ($productId == "" || $userId == "" || $quantity == "") {
    http_response_code(403);
    $response = ["msg" => "Looks like you missed some fields. Please check and try again!"];
} else {
    $query = "SELECT * FROM cart WHERE user_id = ? and product_id = ?";
    $params = [$userId, $productId];

    $result = selectOne($query, $params);

    if ($result && is_array($result) && count($result) > 0) {
        http_response_code(403);
        $response = ["msg" => "Product already in the cart. Please choose a different product."];
    } else {
        $query = "INSERT INTO cart (user_id, product_id,quantity) VALUES (?, ?, ?)";
        $params = [$userId, $productId,$quantity];

        $insertResult = execute($query, $params);

        if ($insertResult) {
            $response = ["msg" => "Product added successfully"];
        } else {
            http_response_code(500);
            $response = ["msg" => "Error adding product to cart"];
        }
    }
}

echo json_encode($response);
?>

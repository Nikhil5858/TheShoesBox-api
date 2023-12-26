<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$productId = $data->productId;
$userId = $data->userId;

if ($productId == "" || $userId == "") {
    http_response_code(403);
    $response = ["msg" => "Looks like you missed some fields. Please check and try again!"];
}else{
    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $params = [$userId, $productId];

    $deleteResult = execute($query, $params);

    if ($deleteResult) {
        $response = ["msg" => "Product deleted successfully"];
    } else {
        http_response_code(500);
        $response = ["msg" => "Error deleting product from cart"];
    }
}   

echo json_encode($response);
?>

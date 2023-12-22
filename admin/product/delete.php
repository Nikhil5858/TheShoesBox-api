<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$id = $data->id;

if ($id == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
} else {

    $cartQuery = "DELETE FROM cart WHERE product_id=?";
    $cartParams = [$id];
    execute($cartQuery, $cartParams);

    $productQuery = "DELETE FROM product WHERE id=?";
    $productParams = [$id];
    execute($productQuery, $productParams);

    $response = ["msg" => "Product Deleted Successfully"];
}

echo json_encode($response);
?>

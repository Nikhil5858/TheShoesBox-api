<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$productId = $data->productId;
$userId = $data->userId;

if ($productId == "" || $userId == "") {
    http_response_code(403);
    $response = ["msg" => "Looks like you missed some fields. Please check and try again!"];
} else if ($result->num_rows > 0) {
    $query = "SELECT * FROM cart WHERE user_id = ? and product_id = ?";
    $params = [$user_id, $product_id];
    $result = select($query, $params);
    http_response_code(403);
    $response = ["msg" => "Product already In Cart. Please choose a different Product."];
} else {
    $query = "INSERT INTO cart (user_id,product_id) VALUES(?,?)";
    $params = [$user_id, $product_id];

    execute($query, $params);
    $response = ["msg" => "Product Added Successfully"];
}


// Cart Delete
if ($action == "delete") {
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];


    if ($productId == '' || $userId == '') {
        echo "Looks like you missed some fields. Please check and try again!";
        return;
    }
    $sql = "DELETE FROM cart WHERE user_id = '" . $userId . "' AND product_id = '" . $productId . "'";
    if (mysqli_query($con, $sql)) {
        echo "Product Delete Successfully";
        return;
    }
}

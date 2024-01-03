<?php
include_once '../database/database.php';
$data = json_decode(file_get_contents('php://input'));

$product_id = $data->product_id;
$user_id = $data->user_id;
$quantity = $data->quantity;

if ($product_id == "" || $user_id == "" || $quantity == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}



echo json_encode($response);
?>

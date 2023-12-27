<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$category_id = $data->category_id;
$brand_id = $data->brand_id;
$price = $data->price;
$details = $data->details;
$pro_img = isset($data->pro_img) ? $data->pro_img : null;

if ($name == "" || $category_id == "" || $brand_id == "" || $price == "" || $details == "") 
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
} 

$query = "INSERT INTO product(name, cat_id, brand_id, price, pro_details, pro_img) VALUES (?, ?, ?, ?, ?, ?)";
$params = [$name, $category_id, $brand_id, $price, $details, $pro_img];

$ProductId = execute($query, $params, true);
die(json_encode(["message" => "Product Added Successfully"]));

echo json_encode($response);
?>

<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$id = $data->id;
$name = $data->name;
$category_id = $data->category_id;
$brand_id = $data->brand_id;
$price = $data->price;
$details = $data->details;

if ($name == "" || $category_id == "" || $brand_id == "" || $price == "" || $details == "" || $id == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}

$query = "UPDATE product SET name=?, cat_id=?, brand_id=?, price=?, pro_details=? WHERE id=?";
$params = [$name, $category_id, $brand_id, $price, $details, $id]; 
execute($query, $params);

die(json_encode(["message" => "Product Updated Successfully"]));

echo json_encode($response);
?>

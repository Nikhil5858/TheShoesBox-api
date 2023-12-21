<?php
include_once '/xampp/htdocs/api/database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$category_id = $data->category_id;
$brand_id = $data->brand_id;
$price = $data->price;
$details = $data->details;

if ($name == "" || $category_id == "" || $brand_id == "" || $price == "" || $details == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
} else {
    $sql = "INSERT INTO product(name, cat_id, brand_id, price, pro_details) VALUES (?, ?, ?, ?, ?)";
    $params = [$name, $category_id, $brand_id, $price, $details];

    execute($sql, $params);

    $response = ["msg" => "Product Added Successfully"];
}

echo json_encode($response);
?>

<!-- <?php
        // include_once '/xampp/htdocs/api/database/database.php';

        // $data = json_decode(file_get_contents('php://input'));

        // $name = $data->name;
        // $category_id = $data->category_id;
        // $brand_id = $data->brand_id;
        // $price = $data->price;
        // $details = $data->details;
        // $imgname = $data->pro_img;

        // $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        // $fileExtension = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

        // if ($name == "" || $category_id == "" || $brand_id == "" || $price == "" || $details == "" || $imgname == "") {
        //     http_response_code(403);
        //     $response = ["msg" => "Fill All Fields"];
        // } elseif (in_array($fileExtension, $allowedExtensions)) {
        //     $imgpath = $_FILES['image'];
        //     $folder = "../product" . $imgname;

        //     if (move_uploaded_file($imgpath, $folder)) {
        //         $sql = "INSERT INTO product(name,cat_id,brand_id,price,pro_img,pro_details) VALUES(?,?,?,?,?,?)";

        //         $params = [$name, $category_id, $brand_id, $price, $imgname, $details];
        //         execute($query, $params);
        //         $response = ["msg" => "Product Added Successfully"];
        //     }
        // } else {
        //     http_response_code(403);
        //     $response = ["msg" => "Somthing Went's Wrong. Please Try Again"];
        // }

        // echo json_encode($response)
        ?> -->
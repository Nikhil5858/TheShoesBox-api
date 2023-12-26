<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

if (isset($data->id, $data->imagename)) {

    $id = $data->id;
    $imagename = $data->imagename;

    $imagePath = '../product/images/' . $imagename;
    
    $query = "UPDATE product SET pro_img=? WHERE id=?";
    $params = [$imagename, $id  ];
    execute($query, $params);

    $response = ["msg" => "Image Added Successfully"];
} 
else
{
    $response = ["msg" => "Invalid!"];
}

echo json_encode($response);
?>

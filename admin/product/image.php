<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$id = $data->id;
$imagename = $data->imagename;
$imageData = $data->imageData;

if (!empty($id) && !empty($imagename) && !empty($imageData)) {
    $decodedImage = base64_decode($imageData);

    $destinationFolder = '../product/images/';

    $imagePath = $destinationFolder . $imagename;

    file_put_contents($imagePath, $decodedImage);

    $query = "UPDATE product SET pro_img=? WHERE id=?";
    $params = [$imagename, $id];
    execute($query, $params);

    die(json_encode(["message" => "Image Added Successfully"]));
} else {
    die(json_encode(["message" => "Invalid"]));
}
?>

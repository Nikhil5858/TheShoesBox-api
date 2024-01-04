<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$user_id = $data->user_id;

$query = "SELECT * FROM addressdetails WHERE user_id = ?";
$params = [$user_id];
$response = select($query, $params);

if($response == "")
{
    die(json_encode(["message" => "Address Not Found."]));
}

echo json_encode($response);
?>

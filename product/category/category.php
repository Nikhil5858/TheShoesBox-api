<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$query = "SELECT id,name FROM category";
$response = select($query);


if ($query == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Data Not Found"]));
}


echo json_encode($response)
?>
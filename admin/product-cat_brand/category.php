<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;

if ($name == "")
{
    http_response_code(403);
    die(json_encode(["message" => "Fill All Fields"]));
}

$query = "SELECT * FROM category WHERE name = ?";
$params = [$name];
$response = selectOne($query, $params);
if ($response !== false) {
    http_response_code(403);
    $response = ["message" => "category Name already exists. Please choose a different Name."];
    echo json_encode($response);
    exit;
}

$query = "INSERT INTO category(name) VALUES(?)";
$params = [$name];

$response = execute($query, $params);
die(json_encode(["message" => "category Added Successfully"]));

echo json_encode($response)
?>
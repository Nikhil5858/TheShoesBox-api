<?php 

header( 'Content-Type: application/json');

$data = file_get_contents("php://input");
$json = json_decode($data);

$username = $json->username;
$password = $json->password;

$query = "SELECT `id`, `username` FROM `users` WHERE `username` = ? AND `password` = ?";

$params = [$username, $password];

$connection = new PDO("mysql:host=localhost;port=3306;dbname=androidapp", "root", "");
$statement = $connection->prepare($query);
$statement->execute($params);

$result = $statement->fetch(PDO::FETCH_OBJ);
if(!$result)
{
    http_response_code(401);
    die(json_encode(["message" => "Wrong username or password"]));
}

echo json_encode($result);
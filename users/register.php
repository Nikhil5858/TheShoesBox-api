<?php

header('Content-Type: application/json');

$data = file_get_contents("php://input");
$json = json_decode($data);

$username = $json->username;
$password = $json->password;
$confirmpassword = $json->confirmpassword;

if ($password != $confirmpassword)
{
    http_response_code(400);
    die(json_encode(["success" => false, "message" => "Passwords do not match"]));
}

$connection = new PDO("mysql:host=localhost;port=3306;dbname=androidapp", "root", "");

$query = "SELECT COUNT(*) AS `count` FROM `users` WHERE `username` = ?";
$params = [$username];

$statement = $connection->prepare($query);
$statement->execute($params);
$result = $statement->fetch(PDO::FETCH_OBJ);

if ($result->count > 0)
{
    http_response_code(400);
    die(json_encode(["message" => "Username already taken"]));
}

$query = "INSERT INTO `users` (`username`, `password`) VALUES (?, ?)";
$params = [$username, $password];

$statement = $connection->prepare($query);
$statement->execute($params);

echo json_encode(["success" => true, "message" => "Registration successful"]);
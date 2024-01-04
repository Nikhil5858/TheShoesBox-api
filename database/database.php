<?php

$root = "/TheShoesBox-api";

define("BASE_DIR", $_SERVER['DOCUMENT_ROOT'] . $root);
define("BASE_URL", $root);

date_default_timezone_set('Asia/Kolkata');

$host = "localhost";
$port = 3306;
$dbname = "theshoesbox";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;port=$port;dbname=$dbname";

$connection = new PDO($dsn, $username, $password);

function pathOf($path)
{
    return BASE_DIR . "/" . $path;
}

function urlOf($path)
{
    return BASE_URL . '/' . $path;
}

function execute($query, $params = null)
{
    global $connection;
    
    $statement = $connection->prepare($query);
    return $statement->execute($params);
}

function selectOne($query, $params = null)
{
    global $connection;

    $statement = $connection->prepare($query);
    $statement->execute($params);

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function select($query, $params = null)
{
    global $connection;

    $statement = $connection->prepare($query);
    $statement->execute($params);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function lastInsertId()
{
    global $connection;
    return $connection->lastInsertId();
}

function getLastError()
{
    global $connection;
    return $connection->errorInfo();
}
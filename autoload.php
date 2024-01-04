<?php

function get()
{
    if ($_SERVER['REQUEST_METHOD'] != "GET")
    {
        http_response_code(405);
        die();
    }
}

function post()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") 
    {
        http_response_code(405);
        die();
    }

    return json_decode(file_get_contents('php://input'));
}

function error($httpCode, $error = "")
{
    http_response_code($httpCode);
    die(json_encode(["error" => $error]));
}

function success($message = "")
{
    die(json_encode(["message" => $message]));
}

function reply($data)
{
    die(json_encode($data));    
}

include_once "database/database.php";

header("Content-Type: application/json");

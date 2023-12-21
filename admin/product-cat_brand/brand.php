<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;

if ($name == ""){
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
}else{
    $query = "SELECT * FROM brand WHERE name = ?";
    $params = [$name];
    $result = selectOne($query, $params);
    
    if ($result != "") {
        http_response_code(403);
        $response = ["msg" => "Brand Name already Exits. Please choose a different Name."];
    }else {
        $query = "INSERT INTO brand(name) VALUES(?)";
        $params = [$name];
        
        execute($query, $params);
        $response = ["msg" => "Brand Added Successfully"];
    }
}

echo json_encode($response)
?>
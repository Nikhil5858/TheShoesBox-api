<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));

if (isset($data->id, $data->status)) {
    $id = $data->id;
    $status = $data->status;

    if ($id == "" || $status == "") {
        http_response_code(400);
        die(json_encode(["message" => "Some Fields Not Found"]));
    }

    $sql = "UPDATE `order` SET status=? WHERE id=?";
    $params = [$status, $id];

    if (execute($sql, $params)) {
        http_response_code(200);
        die(json_encode(["message" => "Order Update Successful"]));
    } else {
        http_response_code(500);
        die(json_encode(["message" => "Something Went Wrong. Please Try Again."]));
    }
} else {
    http_response_code(400);
    die(json_encode(["message" => "Required parameters not provided"]));
}
?>

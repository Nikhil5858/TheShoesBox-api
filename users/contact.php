<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$email = $data->email;
$subject = $data->subject;
$message = $data->message;

$email_format = "^[a-z0-9.]+(\.[a-z0-9]+)*@[a-z]+(\.[a-z]+)*(\.[a-z]{2,3})$^";

if ($name == "" || $email == "" || $subject == "" || $message == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
}else if (!preg_match($email_format, $email)) {
    http_response_code(403);
    $response = ["msg" => "Invalid email address."];
}
else {
    $query = "INSERT INTO contact (name,email,subject,message) VALUES(?,?,?,?)";
    $params = [$name, $email, $subject, $message];
    
    execute($query, $params);
    $response = ["msg" => "Your Request Was Added!"];
}

echo json_encode($response)
?>
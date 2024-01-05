<?php

$data = post();

$user_id = $data->user_id;

$query = "SELECT * FROM addressdetails WHERE user_id = ?";
$params = [$user_id];
$response = select($query, $params);

if(!$response)
    error(403, "Address Not Found.");

reply([
    "user_id" => $response
]); 
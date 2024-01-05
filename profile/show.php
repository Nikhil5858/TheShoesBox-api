<?php

$data = post();

$user_id = $data->user_id;

$query = "SELECT * FROM users WHERE id=?";
$params = [$user_id];
$response = selectOne($query,$params);

if (!$response)
    error(403, "Data Not Found");

reply($response);

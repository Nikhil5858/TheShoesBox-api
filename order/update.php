<?php

$data = post();

$order_id = $data->order_id;
$status = $data->status;

$query = "UPDATE `order` SET status = ? WHERE id = ?";
$params = [$status, $order_id];

execute($query, $params);

success();
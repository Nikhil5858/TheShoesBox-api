<?php

$data = post();

$order_id = $data->id;
$status = "Cancel By You";

$query = "UPDATE `order` SET status = ? WHERE id = ?";
$params = [$status, $order_id];

execute($query, $params);
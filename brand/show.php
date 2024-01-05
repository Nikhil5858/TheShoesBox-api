<?php

$data = post();

$query = "SELECT id,name FROM brand";
$response = select($query);

if ($query == "")
    error(403, "Data Not Found");

reply($response);

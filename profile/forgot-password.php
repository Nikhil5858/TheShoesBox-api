<?php

$data = post();

$user_id = $data->user_id;
$old_password = $data->old_password;
$new_password = $data->new_password;
$confirm_password = $data->confirm_password;

if ($old_password == "" || $new_password == "" || $confirm_password == "")
    error(403, "Fill All Fields");

if ($old_password == $new_password)
    error(403, "Old Password Or New Password Both Are Same");

if ($new_password != $confirm_password)
    error(403, "Confirm Password do not match!");

$response = select("SELECT * FROM users WHERE id=? AND password = ?", [$user_id, $old_password]);

if (!$response)
    error(403, "Old Password Wrong");

$query = "UPDATE users SET password=? WHERE id=?";
$params = [$new_password, $user_id];
$response = execute($query, $params);

success("Password Updated Succesfully");

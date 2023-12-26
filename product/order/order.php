<?php
include_once '../../database/database.php';

$data = json_decode(file_get_contents('php://input'));


$action = $_POST['action'];
if ($action == 'pending') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if ($id == "" || $status == "") {
        echo "Some Fields Not Found";
        return;
    }

    $sql = "UPDATE `order` SET status='$status' WHERE id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Order Is Replaced";
        return;
    } else {
        echo "Somthing Went's Wrong. Please Try Again.";
        return;
    }
} else if ($action == 'cancel') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if ($id == "" || $status == "") {
        echo "Some Fields Not Found";
        return;
    }

    $sql = "UPDATE `order` SET status='$status' WHERE id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Order Cancel";
        return;
    } else {
        echo "Somthing Went's Wrong. Please Try Again.";
        return;
    }
}

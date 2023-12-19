<?php
include_once '../database/database.php';

$data = json_decode(file_get_contents('php://input'));

$id = $data->id;
$name = $data->name;
$email = $data->email;
$phoneno = $data->phoneno;

if ($id == "" || $name == "" || $email == "" || $phoneno == "") {
    http_response_code(403);
    $response = ["msg" => "Fill All Fields"];
}else if (!preg_match($email_format, $email)) {
    http_response_code(403);
    $response = ["msg" => "Invalid email address."];
}else if(!preg_match($phoneno_format, $phoneno)){
    http_response_code(403);
    $response = ["msg" => "Invalid Phone Number"];
}
else{
        $query = "SELECT * FROM users WHERE id='$id' && usertype='user'";
        $params = [$id, $name,$email,$phoneno];
        $result = select($query, $params);
        http_response_code(403);
        $response = ["msg" => ""];    
}



//old

    $sql = "SELECT * FROM users WHERE id='$id' && usertype='user'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $oldname = $row['name'];
    $oldemail = $row['email'];
    $oldphoneno = $row['phoneno'];
    if ($name == $oldname && $email == $oldemail && $phoneno == $oldphoneno) {
        echo "You have not made any changes to your profile.";
        return;
    }

    // $query = "SELECT * FROM users WHERE email = '$email'";
    // $result = $con->query($query);
    // if ($result->num_rows > 0) {
    //     echo "User already Exits. Please choose a different user.";
    //     return;
    // }

    $sql = "UPDATE users SET name='$name',email='$email',phoneno='$phoneno' WHERE id='$id' && usertype='user'";
    if (mysqli_query($con, $sql)) {
        echo "Profile Update Successfully";
        return;
    } else {
        echo "Somthing Went's Wrong. Please Try Again.";
        return;
    }
// Update Password
elseif ($action == "updatepassword") {
    $id = $_POST['id'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $repass = $_POST['repass'];
    if ($id == "" || $oldpass == "" || $newpass == "" || $repass == "") {
        echo "Looks like you missed some fields. Please check and try again!";
        return;
    }

    $sql = "SELECT * FROM users WHERE id = '$id' && usertype='user'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    if ($oldpass !== $password) {
        echo "Old Password Is Wrong. Please Check Your Old Password.";
        return;
    }

    if ($oldpass == $newpass) {
        echo "Old Password Or New Password Both Are Same. Please Chois Different Password";
        return;
    }

    if ($newpass !== $repass) {
        echo "Confirm Password do not match!";
        return;
    }

    $sql = "UPDATE users SET password = '$newpass' WHERE id = '$id' && usertype='user'";
    if (mysqli_query($con, $sql)) {
        echo "Password Change Successfuly.";
        return;
    } else {
        echo "Somthing Went's Wrong. Please Try Again.";
        return;
    }
}

// Any Else
else {
    echo "Somthing Went's Wrong. Please Reload The Page And Try Again.";
}
mysqli_close($con);

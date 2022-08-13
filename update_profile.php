<?php
require 'connection.php';
require 'function.php';
session_start();
$old_name = $_SESSION['name'];
echo var_dump($_FILES);
$name = $_POST['edit_name'];
$email = $_POST['edit_email'];
$profilename =  $_FILES['edit_profile']['name'];

if ($profilename != '') {
    $profile_tmp = $_FILES['edit_profile']['tmp_name'];
    $profile_type = $_FILES['edit_profile']['type'];
    $upload_profile = "upload_pics/";

    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $id = $row['id'];

    $filename = renamefilename($id, $profile_type);
    unlink("upload_pics/" . $row['profile']);

    move_uploaded_file($profile_tmp, $upload_profile . $profilename);

    rename($upload_profile . $profilename, $upload_profile . $filename);
    $update = "UPDATE register SET name = '$name', profile = '$filename' WHERE email = '$email'";
} else {
    $update = "UPDATE register SET name = '$name' WHERE email = '$email'";
}

$result = mysqli_query($conn, $update);
//This will update the database profile name. Ex: If you liked one post and after that you change your name then another post liked so both name will be updated and show name in database which you updated in last.
if ($result) {
    $_SESSION['name'] = $name;
    $update = "UPDATE likes SET user = '$name' WHERE user = '$old_name'";
    $update_like_name = mysqli_query($conn,$update);
    if($update_like_name)
    {
        echo '1';
    }
    else{
        echo '0';
    }

} else {
    echo '0';
}

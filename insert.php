<?php
require 'connection.php';
function renameprofile($id, $filetype)
{
    $ext='';
    if($filetype == "image/jpeg")
    {
        $ext = '.jpeg';
    }
    elseif($filetype == "image/jpg")
    {
        $ext = '.jpg';
    }
    elseif($filetype == "image/png")
    {
        $ext = '.png';
    }
    elseif($filetype == "image/gif")
    {
        $ext = '.gif';
    }
    return $id . $ext;
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pwd'],PASSWORD_DEFAULT);

    $profile_name = $_FILES['profile']['name'];
    $profile_tmp = $_FILES['profile']['tmp_name'];
    $profile_type = $_FILES['profile']['type'];
    $uploads = "upload_pics/";

    // Extracting the maximum id for record
    $lastidsql = "SELECT * from register";
    $idresult = mysqli_query($conn, $lastidsql);

    $id = mysqli_num_rows($idresult);
    $id+=1;


    //New name of the image file
    $filename = renameprofile($id, $profile_type);

    //Moving the Image file to Upload Folder
    move_uploaded_file($profile_tmp, $uploads . $profile_name);

    //Renaming the Image file name to new name.
    rename($uploads . $profile_name, $uploads . $filename);

    $sql = "INSERT INTO `register` (`id`,`name`, `email`,`profile`,`pwd`) VALUES ('{$id}','{$name}', '{$email}', '{$filename}','{$password}')";

    $result = mysqli_query($conn, $sql);
    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
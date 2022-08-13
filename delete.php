<?php

require 'connection.php';
$id = $_GET['id'];
$sql_delete = "DELETE FROM `blog` WHERE srno = $id";
$result = mysqli_query($conn,$sql_delete);

if($result)
{
    header('Location: profile.php');
    die();
}
else
{
    $err = mysqli_error($conn);
    echo "Not deleted successfully due to this error --> $err";
}
?>
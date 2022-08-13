<?php
require "connection.php";
$email = $_POST['email'];

$sql = "SELECT * FROM register WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

$rows = mysqli_num_rows($result);

if($rows>=1)
{
    echo '1';
}
else
{
    echo '0';
}
?>
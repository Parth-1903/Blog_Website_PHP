<?php require 'connection.php';

echo var_dump($_POST);
$person_id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO `blog` (title, content, fid) VALUES ('{$title}', '{$content}', '{$person_id}')";

if(mysqli_query($conn, $sql))
{
    echo 1;
}
else
{
    echo 0;
}
?>
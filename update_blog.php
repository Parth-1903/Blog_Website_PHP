<?php 
require 'connection.php';
 var_dump($_POST);
 $id = $_POST['id'];
 $title = $_POST['title'];
 $blog_id = $_POST['blog'];
 $content = $_POST['content'];

 $sql1 = "UPDATE `blog` SET `title` = '$title' , `content` = '$content' WHERE srno = $blog_id";
 $result = mysqli_query($conn, $sql1);

 if($result)
 {
     echo '1';
 }
 else
 {
     echo '0';
 }

?>
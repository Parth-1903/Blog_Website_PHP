<?php
require "connection.php";
// $email
// echo var_dump($_POST);
 $email = $_POST['email'];
 $pwd = $_POST['pwd'];
 $sql = "SELECT * from register WHERE email = '$email'";
 $result = mysqli_query($conn,$sql);
 $no_rows = mysqli_num_rows($result);

 if($no_rows == 1)
 {
     $row = mysqli_fetch_assoc($result);
     $password_verify = password_verify($pwd , $row['pwd']);
     if($password_verify)
     {
         session_start();
         $_SESSION['id'] = $row['id'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['profile'] = $row['profile'];
         $_SESSION['dbms_assignment'] = 'true';
         echo '1';
     }
     else
     {
         echo '2';
         header('location:form.php');
     }
 }
 else{
     echo '3';
     header('location:form.php');

 }
?>
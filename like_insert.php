<?php
require('connection.php');
session_start();
    if (isset($_POST['like'])) {
        $postid = $_POST['hidden'];
        $user = $_SESSION['name'];
        $id = $_SESSION['id'];
        $sql = "INSERT INTO likes (fid, user, post_id) VALUES ($id,'$user', '$postid')";
        echo "$sql";
        $query = mysqli_query($conn, $sql);
        if ($query == 1) {
            echo "<script> location.replace('home.php');</script>";
        }
    }

    ?>
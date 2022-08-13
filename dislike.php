<?php
    require('connection.php');
    session_start();
    if (isset($_POST['dislike'])) {
        $postid = $_POST['hidden_dislike'];
        $user = $_SESSION['name'];
        $id = $_SESSION['id'];
        $sql = "DELETE FROM likes WHERE user = '$user' AND post_id = '$postid' AND fid = '$id'";
        echo "$sql";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "Dislike is completed";
            echo "<script> location.replace('home.php');</script>";
        }
    }


?>
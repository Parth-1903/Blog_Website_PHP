<?php
require 'connection.php';
?>
<?php
session_start();
if (!$_SESSION['dbms_assignment']) {
    header('location:login.php');
}
$sql1 = "SELECT a.srno, a.title,a.content,a.fid,b.id, b.name, b.profile, b.dt FROM blog a , register b WHERE a.fid = b.id";

$result = mysqli_query($conn, $sql1);

?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        if (<?php if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $user_name = $_SESSION['name'];
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM register WHERE email = '$email'";
                $data = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($data);
                $person_id = $row['id'];
                $name = $row['name'];
                $email_1 = $row['email'];
                $profile = $row['profile'];

                echo 1;
            } else {
                echo 0;
            }; ?>)

        {

        }



    });
</script>


<?php include "partials/header.php"; ?><br>
<div class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">
                Home
            </h1>
            <p class="lead my-3">
                Hello, we welcome you to the daily journal blogs, hope you enjoy writing blogs....
                <!-- <%=blogs[0].content.substring(0, 100)+'....'%> -->
            </p>
            <p class="lead mb-0"><a href="about.php" class="text-white fw-bold">Continue reading...</a>
            </p>
        </div>
    </div>
</div>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="css/home.css"> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, 
        initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <style>
        body {
            background-color: #E5E7E9;
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php while ($row = mysqli_fetch_array($result)) :
                $srno = $row['srno'];
                $u_name = $row['name']; ?>
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="col-auto d-lg-block">
                            <img class="bd-placeholder-img rounded-circle" width="140" height="140" id="profile_img" src="upload_pics/<?php echo $row['profile']; ?>" alt="<?php echo $row['profile']; ?>" style="margin-top: 30px;
                                margin-right: 30px;
                                width: 126px;
                                height: 118px;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <div class="mb-1 text-muted date1" style="font-size: small;">

                                <?php $date = $row['dt'];
                                $piece = date("F j, Y");
                                echo $piece;
                                ?>
                            </div><br>
                            <p class="card-text">
                                <?php echo substr($row['content'], 0, 48); ?>
                            </p>

                            <a href="show.php?id=<?php echo $srno ?>" class="btn btn-outline-primary btn-sm">
                                Continue Reading
                            </a>
                            <?php
                            $sql2 = "SELECT * FROM likes WHERE post_id = '$srno' AND user = '$user_name' AND fid = '$id'";
                            $query2 = mysqli_query($conn, $sql2);
                            $numrows = mysqli_num_rows($query2);

                            if ($numrows) {
                                echo "
                                    <form action='dislike.php' method='POST' style='margin-top: 15px; margin-left: -18px;'>
                                    <input type = 'hidden' name = 'hidden_dislike' value = '" . $srno . "'>
                                    &ensp; &ensp;<input type = 'submit' value = 'Dislike' name='dislike' class='btn btn-outline-primary btn-sm'>
                                </form>
                                    ";
                            } else {
                                echo "
                                <form action = 'like_insert.php'
                                method='POST' style='margin-top: 15px; margin-left: -18px;'>
                                    <input type = 'hidden' name = 'hidden' id = 'hidden' value = '.$srno.'>
                                    <input type = 'hidden' name = 'hidden_user' id = 'hidden_user' value = '.$user_name.'>
                                    &ensp; &ensp;";
                                echo "<input type = 'submit'  name='like' id = 'like'value = 'Like' class='btn btn-outline-primary btn-sm'>
                                </form>
                                    ";
                            }

                            $sql6 = "SELECT * FROM likes WHERE post_id = '$srno'";
                            $query6 = mysqli_query($conn, $sql6);
                            $numrows6 = mysqli_num_rows($query6);
                            echo
                            "<p>$numrows6 likes</p>";
                            ?>

                        </div>

                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <?php include "partials/footer.php" ?>
</body>

</html>
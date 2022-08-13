<?php include "partials/header.php" ?>
<?php 
session_start();
if(!$_SESSION['dbms_assignment'])
{
    header('location:login.php');
}
require 'connection.php'; ?>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    if (<?php if (isset($_SESSION['id'])) {
          $id = $_SESSION['id'];
          $email = $_SESSION['email'];

          $sql = "SELECT * FROM register WHERE email = '$email'";
          $data = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($data);
          $person_id = $row['id'];
          $name = $row['name'];
          $email_1 = $row['email'];;
          $profile = $row['profile'];

          echo 1;
        } else {
          echo 0;
        }; ?>)

    {
      $('#profile_img').attr('src', "upload_pics/<?php echo $profile; ?>");
      $('#profile_img').show();
      $('#name').html('<?php echo $name; ?>')
    }



  });
</script>

<head>
<style>
    body{
      background-color: #E5E7E9;
    }
    </style> 
</head>


<section class="information" id='information' style="margin:4% 25%; ">
  <div class="conatiner">
    <div class="row">
      <div class="row g-0  rounded overflow-hidden flex-md-row mb-4  h-md-250 position-relative">
        <div class="col-auto d-none d-lg-block">
        </div>
        <div class="col p-4 d-flex flex-column position-static" style="text-align: center;">
          <!-- <strong class="d-inline-block mb-2 text-primary">genre</strong> -->
          <img class="bd-placeholder-img rounded-circle" width="140" id='profile_img' alt='Profile' height="140" style="position: relative; margin: auto;" />
          <h4 class="mb-0" id='name' style="text-align: center; margin-top: 6%;">
            <!-- <%=myuser.name%> -->

          </h4><br>
          <div style="text-align: center;">

            <button type="button" class="btn btn-dark btn-sm" id='change_profile' style="width: 200px;">Change
              Profile</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





<div class="container" id='buttons' style="margin: 4% 4%; margin-left: 7%;">
  <div class="row">
    <div class="col-6" style="text-align: right;">
      <button type="button" class="btn btn-dark btn-sm"><a id='compose_btn' name='compose_btn' style="text-decoration: none;color: white;">
          COMPOSE</a></button>
    </div>
    <div class="col-6">
      <form action="/log" method="post">
        <button type="submit" class="btn btn-dark btn-sm" id='logout_btn'>LOG OUT</button>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('#logout_btn').on('click', function(e) {

      $.ajax({
        url: "logout.php",
        type: "POST",
        success: function(data) {
          window.location.href = "form.php";
        }
      });
    });

    $('#change_profile').on('click', function(e) {
      e.preventDefault();
      $('#information').hide();
      $('#blog_data').hide();
      $('#buttons').hide();

      $.ajax({
        url: 'edit-profile.php',
        type: 'POST',
        data: {
          id: '<?php echo $id; ?>'
        },
        success: function(editprofile) {
          $('#update_profile').html(editprofile);
          $('#update_profile').show();
        }
      });
    });

    $('#compose_btn').on('click', function(e) {
      e.preventDefault();
      $('#information').hide();
      $('#blog_data').hide();
      $('#buttons').hide();

      $.ajax({
        url: 'compose.php',
        type: 'POST',
        data: {
          id: '<?php echo $id; ?>',
          email: '<?php echo $email ?>'
        },
        success: function(compose) {
          $('#compose').html(compose);
          $('#compose').show();
        }
      });
    });




  });
</script>

<?php
$sql1 = "SELECT * FROM `blog` WHERE fid = '$person_id'";    
$result = mysqli_query($conn, $sql1);
?>

<div id = "blog_data">
<?php while ($row = mysqli_fetch_array($result)) : ?>
    <div class="container">
      <div class="p-3 p-md-4 mb-3 text-white rounded bg-dark">
        <div class="col px-0">
          <h1 class="display-4 fst-italic">
            <?php echo $row['title']; ?>
          </h1>
          <p class="lead my-3">
            <?php echo $row['content']; ?>
          </p>
          <div class="row">
            <div class="col-1">
              <form method="post">
              <a class="btn btn-outline-light" href="edit_blog.php?id=<?php echo $row['srno'];?>" role="button">EDIT</a>
              </form>
            </div>
            <div class="col-11">
              <form method="post">
              <a class="btn btn-outline-light" href="delete.php?id=<?php echo $row['srno'];?>"  onclick = "return confirm('Are you sure want to delete this blog?');"role="button">DELETE</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php endwhile; ?>
</div>

<div id='update_profile'></div>

<div id='compose'></div>

<div id='edit_blog'></div>
<?php include "partials/footer.php"; ?>
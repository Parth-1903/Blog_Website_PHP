<?php
require 'connection.php';


$id = $_GET['id'];
$sql = "SELECT blog.srno, blog.title,blog.content, blog.fid, register.id, register.name,register.email FROM blog, register WHERE blog.fid = register.id AND blog.srno = $id";


$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

?>

<?php include "partials/header.php"; ?><br>
<style>
  #bottom {
    position: absolute;
    bottom: 0;
    left: 0;
  }
</style>
<div class="row featurette" style="margin: 4% 4%;">
  <div class="col-md-7">
    <h2 class="featurette-heading"><?php echo $row['title']; ?><span class="text-muted">
        <h6><?php echo $row['name']; ?></h6>
      </span></h2>
    <p class="lead" style="font-size: x-large; "><?php echo $row['content']; ?></p>
    <div id=bottom_btn>
      <button class="btn btn-outline-dark" type="submit" name="back" id="back">Back</button>
    </div>
  </div>
  <div class="col-md-5" style="margin: auto;">
    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="https://source.unsplash.com/500x500/?coding,blog" alt="img">
  </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#back').on('click', function(e) {
      e.preventDefault();
      window.location = "home.php";
    });
  });
</script>
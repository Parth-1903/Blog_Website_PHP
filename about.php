<?php include "partials/header.php"?>
<?php
include 'connection.php';
session_start();
if(!$_SESSION['dbms_assignment'])
{
    header('location:login.php');
}

?>

<div class="row featurette" style="margin: 4% 4%;">
    <div class="col-md-7">
      <h2 class="featurette-heading">ABOUT US<span class="text-muted"><h5></h5></span></h2>
      <p class="lead">Hac habitasse platea dictumst vestibulum rhoncus est pellentesque. Dictumst vestibulum rhoncus est pellentesque elit ullamcorper. Non diam phasellus vestibulum lorem sed. Platea dictumst quisque sagittis purus sit. Egestas sed sed risus pretium quam vulputate dignissim suspendisse. Mauris in aliquam sem fringilla. Semper risus in hendrerit gravida rutrum quisque non tellus orci. Amet massa vitae tortor condimentum lacinia quis vel eros. Enim ut tellus elementum sagittis vitae. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
    </div>
    <div class="col-md-5" style="margin: auto;">
      <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" 
      src="https://picsum.photos/seed/hey/500/500" alt="img">
    </div>
</div>

<?php include "partials/footer.php"?>
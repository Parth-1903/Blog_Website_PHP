<?php include "partials/header.php"?>
<?php 
session_start();
if(!$_SESSION['dbms_assignment'])
{
    header('location:login.php');
}
?>
<div class="row featurette" style="margin: 4% 4%;">
    <div class="col-md-7">
      <h2 class="featurette-heading">CONTACT<span class="text-muted"><h5></h5></span></h2>
      <p class="lead">Scelerisque eleifend donec pretium vulputate sapien. Rhoncus urna neque viverra justo nec ultrices. Arcu dui vivamus arcu felis bibendum. Consectetur adipiscing elit duis tristique. Risus viverra adipiscing at in tellus integer feugiat. Sapien nec sagittis aliquam malesuada bibendum arcu vitae. Consequat interdum varius sit amet mattis. Iaculis nunc sed augue lacus. Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Pulvinar elementum integer enim neque. Ultrices gravida dictum fusce ut placerat orci nulla. Mauris in aliquam sem fringilla ut morbi tincidunt. Tortor posuere ac ut consequat semper viverra nam libero.</p>
    </div>
    <div class="col-md-5" style="margin: auto;">
      <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" 
      src="https://picsum.photos/seed/contact/500/500" alt="img">
    </div>
</div>

<?php include "partials/footer.php"?>
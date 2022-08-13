<?php
require 'connection.php';
$id = $_POST['id'];

$select = "SELECT * FROM register WHERE id = $id";
$result = mysqli_query($conn, $select);
if (mysqli_num_rows($result) != 0) {
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $email = $row['email'];
  $profile = $row['profile'];
}
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Validation>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
<script>
  $(document).ready(function() {
    $('#edit_name').blur(function() {
      validateeditname();
    });

    function validateeditname() {
      let editname = $('#edit_name').val();
      let editnameformat = /^[A-Za-z\s]+$/;

      if (editname.length == 0) {
        $('#name_error').html("! This field is required");
        return false;
      } else if (!editname.match(editnameformat)) {
        $('#name_error').html("X Name must not contains numbers");
        return false;

      } else if (editname.length < 3) {
        $('#name_error').html("&nbsp; X Firstname length must be 3 to 20 characters!");
        return false;
      } else if (editname.length > 20) {
        $('#name_error').html("&nbsp; X Firstname length must be 3 to 20 characters!");
        return false;
      } else {
        $('#name_error').html('');
        // $('#name_error').hide();AAD
        return true;
      }
    }



    function validateeditprofile() {
      let image = $("input[name = 'edit_profile']").val();
      console.log(image);
      let imageformat = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

      if (image == '') {
        return true;
      } else if (!imageformat.exec(image)) {
        $('#profile_error').html('* Please Choose Valid image format file (.jpg, .jpeg, .png, .gif)');
        $("input[name = 'edit_profile']").val("");
        return false;
      }
      return true;
    }



    $('#update_form').on('submit', function(e) {
      e.preventDefault();
      let validname = validateeditname();
      let validprofile = validateeditprofile();
      // let profile = $('input[name = "edit_profile"]').val();

      let valid = validname == true && validprofile == true;
      console.log(validname);
      console.log(validprofile);
      if (valid) {
        $.ajax({
          url: 'update_profile.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            console.log(data);
            window.location = "profile.php";
            location.reload();
          }
        });
      }
    })

  });
</script>


<head>
  <link rel='stylesheet' href="css/form.css">
</head>
<!-- <form id = edit_form> -->
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Update Profile</h3>
            <form id="update_form"  enctype="multipart/form-data">

              <div class="row">
                <div class="col-md-12 mb-6">

                  <div class="form-outline">
                    <label class="form-label" for="name">Name <span id='name_error' style="color: red;">&nbsp;</span></label>
                    <input type="text" id="edit_name" name="edit_name" value="<?php echo $name; ?>" class="form-control form-control-lg" />
                  </div>

                </div>
                <br>
                <div class="col-md-12 mb-6">

                  <div class="form-outline">
                    <label class="form-label" for="Email">Email</label>
                    <input type="email" id="edit_email" name="edit_email" class="form-control form-control-lg" value="<?php echo $email; ?>" readonly />
                  </div>

                </div>
              </div>

              <div class="col-md-12 mb-6">

                <div class="form-outline">
                  <label class="form-label" for="Profile">Profile <span id='profile_error' style="color: red;">&nbsp;</span></label>
                  <input type="file" id="edit_profile" name='edit_profile' value="<?php echo $profile; ?>" class="form-control form-control-lg" /><?php echo $profile; ?>
                </div>

              </div>
              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" id='submit_btn' type="submit" value="Submit" />
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
</section>
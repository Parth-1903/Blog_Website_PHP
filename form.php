<?php include 'connection.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <style>
        body {
            background-image: url('images/38123.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .form-container {
            background-image: url('images/38123.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        p {
            /* text-align:left; */
            position: absolute;
            color: red;
            z-index: 2;
            font-size: 10px;
        }
    </style>
    <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<login>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <div class="center">
        <h1 style="color:aliceblue; text-align:center; margin-bottom:-50px;">Daily Journal</h1>
    </div>
    <div class="form-container" id='login'>

        <form id='login_form' method="POST">
            <h3>login now</h3>
            <label for="email" class="text-info" style="color: white;  display: flex;">Email:<span style="color: red;" id='email_login_error'>&nbsp; *&nbsp; </span></label>
            <input type="email" name="email_login" id='email_login' placeholder="enter your email">

            <label for="password" class="text-info" style="color: white;  display: flex;">Password:<span style="color: red;" id='pwd_login_error'>&nbsp; *&nbsp; </span></label>
            <input type="password" name="password_login" id='password_login' placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="" id='register_link'>register now</a></p>
        </form>
    </div>

    <!-- <button type="button" class="btn btn-outline-dark">Dark</button> -->
    <!-- <<<<<<<<<<<<<<<<<<<<<<<<<starting>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <div id="buttons">
        <div id="action_btn" style="margin-top: 250px;">
            <center>
                <button class="button button1" id="login_btn">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="button button2" id="register_btn">Register</button>
            </center>
        </div>
    </div>
    <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <br><br>
    <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Register>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <div class="form-container">

        <form action="form.php" id="registration" method="post">
            <h3>register now</h3>

            <label for="name" class="text-info" style="color: white;  display: flex;">Name:<span style="color: red;" id='name_error'>&nbsp; *&nbsp; </span></label>
            <input type="text" name="name" id='name' placeholder="enter your name">
            <!-- <p id="name_error" class="name_error" style="color: red;"></p> -->

            <label for="email" class="text-info" style="color: white;  display: flex;">Email:<span style="color: red;" id="email_error">&nbsp;*&nbsp;</span></label>
            <input type="email" name="email" id='email' placeholder="enter your email">
            <!-- <p id="email_error" class="email_error" style="color: red;"></p> -->

            <label for="profile" class="text-info" style="color: white;  display: flex;">Profile Pic:<span style="color: red;" id="profile_error">&nbsp;*&nbsp;</span></label>
            <input type="file" name="profile" id='profile' placeholder="Choose your profile">
            <!-- <div id="display_image"></div> -->
            <!-- <p id="profile_error" class="profile_error" style="color: red;"></p> -->

            <label for="password" class="text-info" style="color: white;  display: flex;">Password:<span style="color: red;" id="pwd_error">&nbsp;*&nbsp;</span></label>
            <input type="password" name="pwd" id='pwd' placeholder="enter your password">
            <!-- <p id="pwd_error" class="pwd_error" style="color: red;"></p> -->

            <label for="check_password" class="text-info" style="color: white;  display: flex;">Check Password:<span style="color: red;" id="cpwd_error">&nbsp;*&nbsp;</span></label>
            <input type="password" name="cpwd" id='cpwd' placeholder="confirm your password">
            <p id="cpwd_error" class="cpwd_error" style="color: red;"></p>

            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="" id='login_link'>login now</a></p>
        </form>

    </div>

</body>

</html>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#login').hide();
        $('#registration').hide();

        $('#login_btn').on('click', function(e) {
            e.preventDefault();
            $('#registration').hide();
            $('#buttons').hide();
            $('#login').show();
        });
        $('#register_btn').on('click', function() {
            $('#login').hide();
            $('#registration').show();
            $('#buttons').hide();
        })

        $('#register_link').on('click', function(e) {
            e.preventDefault();
            $('#login').hide();
            // location.reload();
            $('#registration').show();
            $('#buttons').hide();
        })
        $('#login_link').on('click', function(e) {
            e.preventDefault();
            $('#registration').hide();
            $('#buttons').hide();
            $('#login').show();
        })

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Validation>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $('#name').blur(function() {
            validatename();
        });

        function validatename() {
            let name = $('#name').val();
            let nameformat = /^[A-Za-z\s]+$/;
            if (name.length == 0) {
                $('#name_error').html(" &nbsp; * Field is required!");
                return false;
            } else if (!name.match(nameformat)) {
                $('#name_error').html('&nbsp; X Name must not contain numbers!');
                return false;
            } else if (name.length < 3) {
                $('#name_error').html("&nbsp; X Firstname length must be 3 to 20 characters!");
                return false;

            } else if (name.length > 20) {
                $('#name_error').html("&nbsp; X Firstname length must be 3 to 20 characters!");
                return false;
            } else {
                $('#name_error').html('');
                return true;
            }
        }
        $('#email').blur(function() {
            validateemail();
        });

        function validateemail() {
            let email = $('#email').val();
            let emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (email.length == 0) {
                $('#email_error').html('&nbsp; * Field is required!');
                return false;
            } else if (!email.match(emailformat)) {
                $('#email_error').html("&nbsp; X Please provide valid email address!");
                return false;
            } else {
                // checkaccount = "";
                var valid = false;
                $.ajax({
                    url: "check-email.php",
                    async: false,
                    type: "POST",
                    data: {
                        email: $('#email').val()
                    },
                    success: function(result) {
                        checkaccount = result;
                        if (checkaccount == 1) {
                            $('#email_error').html('&nbsp; * Account already exists! Try another account');
                            valid = true;
                        } else if (checkaccount == 0) {
                            $('#email_error').html('');
                            valid = false;
                        }
                    }
                });
                if (valid == true) {
                    return false;
                } else if (valid == false) {
                    return true;
                }
                // alert(checkaccount);

            }

        }
        $('#profile').on('change', function() {
            validateprofile();
        });

        function validateprofile() {
            let profile = $('#profile').val();
            let profileformat = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (profile == '') {
                $('#profile_error').html('&nbsp; * Please select your Profile picture!');
                return false;
            } else if (!profileformat.exec(profile)) {
                $('#profile_error').html('&nbsp; * Please Choose valid Image format (.jpg , .jpeg , .png , .gif)');
                return false;
            } else {
                $('#profile_error').html('');
                return true;
            }
        }


        $('#pwd').blur(function() {
            validatepwd();
        });

        function validatepwd() {
            pwd = $('#pwd').val();
            if (pwd == '') {
                $('#pwd_error').html('&nbsp; * Field is required!');
                return false;
            } else if (pwd.length < 6) {
                $('#pwd_error').html("&nbsp; * Password should be greater than 6 characters!");
                return false;
            } else {
                $('#pwd_error').html('');
                return true;
            }
        }

        $('#cpwd').blur(function() {
            validatecpwd();
        });

        function validatecpwd() {
            let pwd = $('#pwd').val();
            let cpwd = $('#cpwd').val();
            if (cpwd == '') {
                $('#cpwd_error').html('&nbsp; * Field is required');
                return false;
            } else if (pwd != cpwd) {
                $('#cpwd_error').html("&nbsp; *Password doesn't exists!");
                return false;
            } else {
                $('#cpwd_error').html('');
                return true;
            }
        }



        $('#registration').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var profile = $('#profile').val();
            var pwd = $('#pwd').val();

            let checkname = validatename();
            let checkemail = validateemail();
            let checkprofile = validateprofile();
            let checkpwd = validatepwd();
            let checkcpwd = validatecpwd();
            console.log(checkemail);
            // alert(checkemail);
            let check = (checkname == true && checkemail == true && checkprofile == true && checkpwd == true && checkcpwd == true);
            if (check) {
                $.ajax({
                    url: 'insert.php',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        // alert("Enter into the success")
                        if (data == 1) {
                            alert("Registration Successfully");
                            $('#registration').fadeOut(1000).hide(0);
                            $('#buttons').hide();
                            $('#login').fadeIn();
                            // $('#')
                        } else {
                            alert("Failed");
                        }
                    }
                });
            }
        });
    });
</script>




<!-- <<<<<<<<<<<<<<<<<<<<< This is for login page validation and AJAX >>>>>>>>>>>>>>>>>>>>>>>>>> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#email_login').blur(function() {
            validateloginemail();
        });

        function validateloginemail() {
            let login_email = $('#email_login').val();
            let login_emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (login_email.length == 0) {
                $('#email_login_error').html('* &nbsp; Please Enter your Email');
                return false;
            } else if (!login_email.match(login_emailformat)) {
                $('#email_login_error').html('* &nbsp; X Please Provide valid email address');
                return false;
            } else {
                var valid = false;
                $.ajax({
                    url: "check_login_email.php",
                    async: false,
                    type: 'POST',
                    data: {
                        email: $('#email_login').val()
                    },
                    success: function(result) {
                        check_acc = result;
                        if (result == 1) {
                            $('#email_login_error').html('&nbsp; * Email is not registered!');
                            valid = true;
                        } else if (result == 0) {
                            $('#email_login_error').html('');
                            valid = false;
                        }
                    }
                });
                if (valid == true) {
                    // $('#email_login_error').html('&nbsp; * Email is not registered!');
                    return false;
                } else if (valid == false) {
                    // $('#email_login_error').html('');
                    return true;
                }
            }
        }

        $('#password_login').blur(function() {
            validateloginpwd();
        });

        function validateloginpwd() {
            login_pwd = $('#password_login').val();
            if (login_pwd == '') {
                $('#pwd_login_error').html("* &nbsp; Please Enter your Password");
                return false;
            } else if (login_pwd.length < 6) {
                $('#pwd_login_error').html("* &nbsp; Please Enter Correct Password");
                return false;
            } else {
                $('#pwd_login_error').html('');
                return true;
            }
        }

        $('#login_form').on('submit', function(e) {
            e.preventDefault();
            check1_email = validateloginemail();
            check1_pwd = validateloginpwd(); 
            check_login = (check1_email == true && check1_pwd == true)
            if (check_login) {

                $.ajax({
                    url: 'login.php',
                    type: 'POST',
                    data: {
                        email: $('#email_login').val(),
                        pwd: $('#password_login').val()
                    },
                    success: function(login_data) {
                        if (login_data == 3) {
                            $('#email_login_error').html("* &nbsp; Invalid Email");
                        } else if (login_data == 2) {
                            $('#pwd_login_error').html("* &nbsp; Invalid Password");
                        } else if (login_data == 1) {
                            alert('Successfully Login');
                            $loggedin = true;

                            window.location.href = 'home.php';
                        }

                    }
                });
            }

        });
    });
</script>
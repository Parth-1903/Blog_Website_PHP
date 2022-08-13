<?php require 'connection.php';

// echo var_dump($_POST);
$id = $_POST['id'];
$email = $_POST['email'];
?>
<section class="composs" style="margin:5% 5%;">
    <h1>COMPOSE</h1>
    <form id='compose_form' method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input id='person_id' value='<?php echo $id; ?>' hidden />
            <label>Title<span style="color: red;" id='title_error'>&nbsp; *&nbsp; </span></label>
            <input class="form-control" type="text" name="title" id="title">
            <label>Post <span style="color: red;" id='content_error'>&nbsp; *&nbsp; </span></label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="5"></textarea>
        </div>
        <br>
        <button class="btn btn-dark" type="submit" name="publish" id="publish">Publish</button>
    </form>
    <br>
    <button class="btn btn-dark" type="submit" name="back" id="back">Back</button>
</section>

<script>
    $(document).ready(function() {
        $('#back').on('click',function(e){
            e.preventDefault();
            location.reload();
        });

        $('#title').blur(function(){
            validtitle();
        });

        function validtitle()
        {
            let title = $('#title').val();
            // let title = $('')
            if(title.length == 0)
            {
                $('#title_error').html("&nbsp; *&nbsp;Field is required! ");
                return false;
            }
            else if(title.length>50)
            {
                $('#title_error').html("&nbsp; *&nbsp;Title should be under 50 words");
                return false;
            }
            else{
                $('#title_error').html('');
                return true;
            }
        }

        $('#content').blur(function(){
            validcontent();
        });

        function validcontent(){
            let content = $('#content').val();
            if(content.length == 0)
            {
                $('#content_error').html('&nbsp; *&nbsp;Field is required!');
                return false;
            }
            else if(content.length>200)
            {
                $('#content_error').html('&nbsp; *&nbsp;Description should be less than 200 words');
                return false;
            }
            else
            {
                $('#content_error').html('');
                return true;
            }
        }

        $('#compose_form').on('submit', function(e) {
            e.preventDefault();
            let titlevalidate = validtitle();
            let contentvalidate = validcontent();
           if(titlevalidate == true && contentvalidate == true) 
           {
            $.ajax({
                url: 'blog_insert.php',
                type: 'POST',
                data: {
                    id: $('#person_id').val(),
                    title: $('#title').val(),
                    content: $('#content').val()
                },
                success: function(data) {
                    console.log(data);
                    alert("Inserted successfully");
                    location.reload();
                    window.location = 'home.php';
                }
            });
        }
        else
        {
            // alert("something problem");
        }
        });
    })
</script>
<?php include "partials/footer.php" ?>
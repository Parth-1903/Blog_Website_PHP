<?php require 'connection.php';
 require 'partials/header.php';
// echo var_dump($_POST);
$id = $_GET['id'];

$sql = "SELECT * FROM `blog` WHERE srno = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- <link type="text/css" rel="stylesheet" href="css/styles.css" > -->
  <!-- <link type="text/css" href="fontawesome/css/all.css" rel="stylesheet" > -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<section class="composs" style="margin:5% 5%;">
    <h1>COMPOSE</h1>
    <form id='compose_form' method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input id='person_id' value='<?php echo $row['fid']; ?>' hidden />
            <input id='blog_id' value='<?php echo $row['srno']; ?>' hidden/><br>
            <label>Title<span style="color: red;" id='title_error'>&nbsp; *&nbsp; </span></label>
            <input class="form-control" value = "<?php echo $row['title']?>"type="text" name="title" id="title">
            <label>Post <span style="color: red;" id='content_error'>&nbsp; *&nbsp; </span></label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="5"><?php echo $row['content']?></textarea>
        </div>
        <br>
        <button class="btn btn-dark" type="submit" name="publish" id="publish">Publish</button>
    </form>
    <br>
    <button class="btn btn-dark" type="submit" name="back" id="back">Back</button>
</section>

<!-- <script src="js/jquery.js"> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').on('click',function(e){
            e.preventDefault();
            window.location = "profile.php";
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
                url: 'update_blog.php',
                type: 'POST',
                data: {
                    id: $('#person_id').val(),
                    blog: $('#blog_id').val(),
                    title: $('#title').val(),
                    content: $('#content').val()
                },

                success: function(data) {
                    console.log(data);
                    alert("Inserted successfully");
                    location.reload();
                    window.location = "profile.php";
                    
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

<?php require 'partials/footer.php';?>
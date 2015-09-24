
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <link  id="bs-css"  href='//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link id="bsdp-css" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
   </head>
<body>

<?php
session_start();
if ( $_SESSION['status'])
{
?>

<form  action="Upload.php" method="post" enctype="multipart/form-data">
    <input type="radio" name="mode" value="create">Create<br>
    <input type="radio" name="mode" value="edit">Edit<br>
    <input type="radio" name="mode" value="delete">Delete


    <h5>Photosession name</h5>
    <input type="text" name="ps_name" placeholder="ex: Egor and Julia">
    <br>
    <h5>Photosession data</h5>


    <div class="span5 col-md-5" id="sandbox-container"><div class="input-group date">
            <input type="text" class="form-control" name="data"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div></div>


    <textarea class='form-control' id='id_comments' name ='descr' placeholder='Description of photosession...' rows='3'></textarea>

    <select class='form-control' id='list' name = 'tag'>

        <option>Wedding</option>
        <option>Inspiration</option>
        <option>Love story</option>
        <option>Family</option>
        <option>Portrait</option>
        <option>Advices</option>

    </select>


    <input type="file" name="small-preview" />
    <input type="file" name="large-preview" />


    <input name="photo_upload[]" type="file" multiple="multiple" />
    <input type="submit" value="Create" />

   </form>

    <form action="exit.php" method="get">
        <input type="submit" value="Exit">
    </form>
    <?php


}

else {
    header("Location: login.php");
}
?>


    <script src="js/jquery/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/admin.js"></script>

</body>
</html>



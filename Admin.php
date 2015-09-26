
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/Admin.css">
    <link  id="bs-css"  href='//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link id="bsdp-css" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
   </head>
<body>

<?php
session_start();
if ( $_SESSION['status'])

{
$mysqli = new mysqli("localhost", "root", "", "mydb");
$mysqli->set_charset("utf8");

$last_id = $mysqli->query("Select max(id) id from mydb.Base");
$new_id=$last_id->fetch_assoc();
$new_id =(int)$new_id['id'];
$new_id++;
?>
<section class = "Full_site_holder">

    <div class = "Main_Side">
        <h1>Hello, Olya!</h1>

        <form id="exit" action="exit.php" method="get">
            <input type="submit" value="Log out" id="log_out">
        </form>


<form  action="Upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name ="id" id ="id" value =<?=$new_id?>>
    <div class="radiob">

        <input type="radio" name="mode" value="create">
            <label for="create">Create</label>

        <input type="radio" name="mode" value="edit">
            <label for="edit">Edit</label>
        <input type="radio" name="mode" value="delete">
            <label for="delete">Delete</label>

    </div>
    <br>
    <br>
    <br>

    <div class="namefield">
        <label for="ps_name">PS name</label>
        <input type="text" id ="ps_name" name="ps_name" placeholder="ex: Egor and Julia">
    </div>
    <br>
    <div class="span5 col-md-5" id="sandbox-container">
        <div class="input-group date">

            <input type="text" class="form-control" name="data"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
    </div>



    <label for='tag'>Select tag</label>
    <select class='form-control' id='list' name = 'tag'>

        <option>Wedding</option>
        <option>Inspiration</option>
        <option>Love story</option>
        <option>Family</option>
        <option>Portrait</option>
        <option>Advices</option>

    </select>
    <br>
    <textarea class='form-control' id='id_comments' name ='descr' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50"></textarea>

    <br>

    <table id ="preview">
        <tr>
            <td>
                    <img  id ="smallimg" src="img/no_img.jpg" alt ="no image">

            </td>
            <td>
               <span> Portfolio preview</span>
                    <input type="file" name="small-preview" id="inp_small" />
            </td>
        </tr>
        <tr>
            <td>
                <img id ="largeimg" src="img/no_img.jpg" alt ="no image">
            </td>
            <td>
                <span> Blog preview</span>
                <input type="file" name="large-preview"  id="inp_large"/>
            </td>
        </tr>

    </table>
    <table id="multy">
        <tr>
            <td>
                <span>
            Load full photosession
                    </span>
            <input name="photo_upload[]" type="file" multiple="multiple" />
            <img src="img/no_img.jpg" alt ="no image"/>
            </td>
        </tr>
        <tr>
            <td>
            <input type="submit" value="Create" id="create" />
            </td>
        </tr>

    </table>

   </form>

    <?php
}

else {
    header("Location: login.php");
}
?>
</div>
    </section>

    <script src="js/jquery/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/admin.js"></script>

</body>
</html>



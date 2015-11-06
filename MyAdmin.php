
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/Admin.css">
    <link  id="bs-css"  href='css/bootstrapMin.css' rel='stylesheet' type='text/css'>
    <link id="bsdp-css" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="libraries/tabs/bootstrap-vertical-tabs-master/bootstrap.vertical-tabs.css">
    <script src="libraries/ckeditor2/ckeditor.js"></script>
   </head>
<body>

<?php
session_start();
if ( $_SESSION['status'])

{
require_once 'includes/data.php';
$mysqli = new mysqli($myServer, $Login,$Passwd , $dbname);
$mysqli->set_charset("utf8");

$last_id = $mysqli->query("Select max(id) id from base");
$new_id=$last_id->fetch_assoc();
$new_id =(int)$new_id['id'];
$new_id++;
?>
<section class = "Full_site_holder">

    <div class = "Main_Side">
        <h1>Hello, Olya!</h1>

        <form id="exit" action="exit.php" method="get">
            <input type="submit" value="Log out" class="buttons" id="log_out">
        </form>


        <div class="col-xs-3"> <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#home" data-toggle="tab">Create</a></li>
                <li><a href="#profile" data-toggle="tab">Edit</a></li>
                <li><a href="#messages" data-toggle="tab">Delete</a></li>
                <li><a href="#settings" data-toggle="tab">Busy days</a></li>
                <li><a href="#additional" data-toggle="tab">Feedbacks</a></li>
            </ul>
        </div>


        <div class="col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Create Tab  -->
                <div class="tab-pane active" id="home">



                    <form  action="Upload.php" method="post" enctype="multipart/form-data">
                        <input type="text" name ="id" id ="id" class="id" value =<?=$new_id?>>

                        <br>
                        <br>
                        <br>

                        <div class="namefield">
                            <label for="ps_name">PS name</label>
                            <input type="text" id ="ps_name" class ="text_input" name="ps_name" placeholder="ex: Egor and Julia">
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
                        <h3>Add description of article(en/ru)</h3>
                        <textarea class='form-control' id='id_comments' name ='descr' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50">
                                Paste english version here
                        </textarea>
                        <textarea class='form-control' id='id_comments_ru' name ='descr_ru' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50">
                                Русcкую версию сюда
                        </textarea>
                        <br>
                        <div class="tablewrap">
                            <table id ="preview">
                                <tr>
                                    <td>
                                        <img  id ="smallimg" src="img/no_img.jpg" alt ="no image">

                                    </td>
                                    <td>
                                        <span> Portfolio preview(300x200)</span>
                                        <input type="file" name="small-preview" id="inp_small" />
                                    </td>
                                    <td>
                                        <img  id ="exsmallimg" src="img/no_img.jpg" alt ="no image">

                                    </td>
                                    <td>
                                        <span> Popular stories(96x96)</span>
                                        <input type="file" name="exsmall-preview" id="inp_exsmall" />
                                    </td>


                                </tr>
                                <tr>
                                    <td>
                                        <img id ="largeimg" src="img/no_img.jpg" alt ="no image">
                                    </td>
                                    <td>
                                        <span> Blog preview(900x400)</span>
                                        <input type="file" name="large-preview"  id="inp_large"/>
                                    </td>
                                    <td>
                                        <img id ="Multy_img" src="img/no_img.jpg" alt ="no image"/>

                                    </td>
                                    <td>
                                <span>
                                     Load full photosession
                                 </span>
                                        <input name="photo_upload[]" type="file" multiple="multiple" id ="Multy_butt" />

                                    </td>
                                </tr>

                            </table>
                            <h3>Add wedding specialists(en/ru)</h3>
                              <textarea class='form-control' id='subcontr' name ='subcontr'  spellcheck="true" rows="10" cols="50">

                             </textarea>
                            <textarea class='form-control' id='subcontr_ru' name ='subcontr_ru'  spellcheck="true" rows="10" cols="50">

                            </textarea>


                            <br>

                            <input type="submit" value="Create"  class ="buttons" id="create" name="CreateButton" />

                        </div>
                    </form>

                    <br>
                    <br>

                </div>

                <!--*******************************************************************
                                            Edit Tab

                  *******************************************************************-->

                <div class="tab-pane" id="profile">




                    <button class ="load"  id="load_edit"> Load </button>
                    <form  action="Upload.php" method="post" enctype="multipart/form-data">


                        <div class="span5 col-md-5" id="sandbox-container">
                            <div class="input-group date">

                                <input type="text" class="form-control" name="edit_date" id="editDate"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

                            </div>
                        </div>

                        <br>

                        <br>

                        <br>
                        <br>
                            <input type="text"  class ="id" name ="edit_id" id ="edit_id">

                        <div class="namefield">

                            <input type="text" id ="edit_name"  class ="text_input" name="edit_ps_name">
                        </div>



                        <select class='form-control' id='edit_list' name = 'edit_tag'>

                            <option>Wedding</option>
                            <option>Inspiration</option>
                            <option>Love story</option>
                            <option>Family</option>
                            <option>Portrait</option>
                            <option>Advices</option>

                        </select>


                        <br>
                        <textarea class='form-control' id='edit_comments' name ='edit_descr' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50"></textarea>
                        <textarea class='form-control' id='edit_comments_ru' name ='edit_descr_ru' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50"></textarea>

                        <br>

                        <table id ="preview">
                            <tr>
                                <td>
                                    <img  id ="edit_smallimg" src="img/no_img.jpg" alt ="no image">

                                </td>
                                <td>
                                    <span> Portfolio preview(300x200)</span>
                                    <input type="file" name="small-preview" id="ed_small" />
                                </td>
                                <td>
                                    <img  id ="edit_exsmallimg" src="img/no_img.jpg" alt ="no image">

                                </td>
                                <td>
                                    <span> Popular stories(96x96)</span>
                                    <input type="file" name="exsmall-preview" id="ed_exsmall" />
                                </td>


                            </tr>
                            <tr>
                                <td>
                                    <img id ="edit_largeimg" src="img/no_img.jpg" alt ="no image">
                                </td>
                                <td>
                                    <span> Blog preview(900x500)</span>
                                    <input type="file" name="large-preview"  id="ed_large"/>
                                </td>
                                <td>
                                    <img id ="Multy_img" src="img/no_img.jpg" alt ="no image"/>

                                </td>
                                <td>
                                <span>
                                     Load full photosession
                                 </span>
                                <input name="photo_upload[]" type="file" multiple="multiple" id="Multy_butt" />

                                </td>
                            </tr>

                        </table>

                         <textarea class='form-control' id='edit_subcontr' name ='edit_subcontr'  spellcheck="true" rows="10" cols="50">

                         </textarea>
                            <textarea class='form-control' id='edit_subcontr_ru' name ='edit_subcontr_ru'  spellcheck="true" rows="10" cols="50">

                            </textarea>
                        <br>

                                    <input type="submit" value="Edit" id="EditButton"  class ="buttons" name ="EditButton" />



                        <br>
                        <br>

                    </form>




                </div>
                <!--*******************************************************************
                                          Delete Tab

                *******************************************************************-->
                <div class="tab-pane" id="messages">


                    <button class ="load"  id="load_delete"> Load </button>
                    <form  action="Upload.php" method="post" enctype="multipart/form-data">


                        <div class="span5 col-md-5" id="sandbox-container">
                            <div class="input-group date">

                                <input type="text" class="form-control" name="delete_date" id="deleteDate"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                        <br>
                        <br>

                        <br>
                        <br>
                        <input type="text"  class ="id" name ="delete_id" id ="delete_id">



                        <div class="namefield">

                            <input type="text" id ="delete_name"  class ="text_input" name="delete_ps_name">
                        </div>

                        <br>
                        <textarea class='form-control' id='delete_comments' name ='delete_descr' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50"></textarea>

                        <br>

                        <table id ="preview">
                            <tr>
                                <td>
                                    <img  id ="delete_smallimg" src="img/no_img.jpg" alt ="no image">

                                </td>
                                <td>
                                    <span> Portfolio preview</span>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img id ="delete_largeimg" src="img/no_img.jpg" alt ="no image">
                                </td>
                                <td>
                                    <span> Blog preview</span>


                                </td>
                            </tr>

                        </table>
                        <input type="submit" value="delete" id="deleteButton" class="buttons" name ="deleteButton" />

                        <br>

                    </form>
                </div>




                <!--*******************************************************************
                          Busy Tab

                *******************************************************************-->

                <div class="tab-pane" id="settings">
                    <!-- Busy days -->
                    <h2>Add working days</h2>
                    <hr>
                    <hr>


                        <div class="span5 col-md-5" id="sandbox-container">
                            <div class="input-group date">

                                <input type="text" class="form-control" name="Busydata" id="BusyDate"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="namefield">
                              <input type="text" id ="Event" name="ps_name" class = "text_input" placeholder="No event for this date">
                        </div>
                        <br>
                        <button id="busyCr" class="buttons">Reserve</button> <span class="status_Add"></span>


                    <!-- Links  -->
                    <h2>Add links in text</h2>
                    <hr>
                    <hr>
                    <table>
                        <tr>
                            <td  class="col_id">ID of link</td>
                            <td>full link</td>
                        </tr>
                        <tr>
                            <td class="col_id"><input type="text" id ="link_id" name="link_id" class = "link_input" placeholder="ID(ex. 1)"></td>
                            <td><input type="text" id ="link_descr" name="link_descr" class = "link_input" placeholder="This ID is free"></td>
                            <td><button  id="Add_link"> Add Link </button></td>
                        </tr>

                    </table>



                </div>


                <!--*******************************************************************
                                       Feedback tab

                             *******************************************************************-->


                <div class="tab-pane" id="additional">

                    <h2>Feedbacks </h2>
                    <form action="Upload.php" method="post" enctype="multipart/form-data">
                        <h3>Date of review</h3>
                        <div class="span5 col-md-5" id="sandbox-container">
                            <div class="input-group date">

                                <input type="text" id = "feed_date" class="form-control" name="feed_data"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>

                        <br>
                        <h3>Name of reviewer</h3>
                        <div class="namefield">

                                <input type="text" id ="feed_name" class ="text_input" name="feed_name" placeholder="ex: Oksana Fieldman">
                        </div>
                            <br>

                                     <textarea class='form-control' id='feedback' name ='feedback' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50">
                                        Feedback engl
                                    </textarea>
                                     <textarea class='form-control' id='feedback_ru' name ='feedback_ru' placeholder='Description of photosession...' spellcheck="true" rows="10" cols="50">
                                        Отзыв рус
                                    </textarea>

                        <div class="tablewrap">
                            <table id ="preview">
                                <tr>
                                    <td>
                                        <img  id ="feed_img" src="img/no_img.jpg" alt ="no image">

                                    </td>
                                    <td>
                                        <span> feedback's collage (900x200)</span>
                                        <input type="file" name="fb-preview" id="inp_feed" />
                                    </td>
                                </tr>
                            </table>

                        <tr>
                            <td> <input type="submit"  value="add FB" id="feedButton" class="buttons" name ="feedButton"></td>
                            <td> <input type="submit"  value="delete FB" id="delfeedButton" class="buttons" name ="delfeedButton"></td>
                        </tr>
                        </div>

                    </form>
                </div>
        </div>


    <?php
}

else {
    header("Location: Login.php");
}
?>
</div>
    </div>
    </section>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'descr' );
        CKEDITOR.replace( 'descr_ru' );
        CKEDITOR.replace( 'edit_descr' );
        CKEDITOR.replace( 'edit_descr_ru' );
        CKEDITOR.replace( 'subcontr' );
        CKEDITOR.replace( 'subcontr_ru' );
        CKEDITOR.replace( 'edit_subcontr' );
        CKEDITOR.replace( 'edit_subcontr_ru' );
        CKEDITOR.replace( 'feedback' );
        CKEDITOR.replace( 'feedback_ru' );
        CKEDITOR.replace( 'edit_feedback' );
        CKEDITOR.replace( 'edit_feedback_ru' );

    </script>

    <script src="js/jquery/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/admin.js"></script>


</body>
</html>



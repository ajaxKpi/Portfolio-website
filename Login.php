<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Hello, Olya</title>
</head>
<body>
<form action="Login.php" method="POST">
    <div align="center" style="padding: 250px 0 0 0">
        <table border="0" cellspacing="0" width="200">
            <caption><b>Enter to the system</b></caption>
            <tr><td align="right"><b>Login:</b></td>
                <td><input type="text" name="login"></td></tr>
            <tr><td align="right"><b>Pass:</b></td>
                <td><input type="password" name="passw"></td></tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" value="Войти">
                </td></tr></table>
        <tr>
            <td>
<?php


require_once 'data.php';
if (isset ($_POST['passw'])) {
    if (md5($_POST['passw'].$Pass_salt) == $Pass_result&&$LoginAdm==$_POST['login']) {
        session_start();
        $_SESSION['status'] = true;
        header('Location: MyAdmin.php');

    }

    else{

        echo '<span style="color: red"><b> Wrong Login/Pass</b></span><br>';
        ;
    }
}

?>


                </td>
            </tr>

    </div>
</form>



</body>
</html>

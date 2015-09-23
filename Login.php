<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php


require_once 'data.php';

if (isset ($_POST['passw'])) {
    if (md5($_POST['passw'].$Pass_salt) == $Pass_result&&$Login==$_POST['login']) {
        session_start();
        $_SESSION['status'] = true;
        header('Location: admin.php');

    }

    else{
        echo '<span style="color: red"><b> Error</b></span><br>';
    }
}

?>


<form action="login.php" method="POST">
    <div align="center" style="padding: 250px 0 0 0">
        <table border="0" cellspacing="0" width="200">
            <caption><b>Вход в систему</b></caption>
            <tr><td align="right"><b>Логин:</b></td>
                <td><input type="text" name="login"></td></tr>
            <tr><td align="right"><b>Пароль:</b></td>
                <td><input type="password" name="passw"></td></tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" value="Войти">
                </td></tr></table>

    </div>
</form>



</body>
</html>

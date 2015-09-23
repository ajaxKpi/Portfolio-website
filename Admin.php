
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
session_start();
if ($_SESSION['status'])
{
    echo  $_SESSION['status'];
    header("Location: index.php");

}

else {
    echo   $t."   cruel World";
}
?>


</body>
</html>



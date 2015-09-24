<?php
/**
 * Created by PhpStorm.
 * User: zvorskyi
 * Date: 23.09.2015
 * Time: 17:36
 */
session_start();
session_unset(); // Удаляем все переменные
session_destroy();
header("Location: index.php");
?>
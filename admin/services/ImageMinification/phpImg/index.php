<?php
/**
 * Created by PhpStorm.
 * User: ivan.zvorskyi
 * Date: 7/7/2016
 * Time: 2:46 PM
 */

require_once("vendor/tinify/tinify/lib/Tinify/Exception.php");
require_once("vendor/tinify/tinify/lib/Tinify/ResultMeta.php");
require_once("vendor/tinify/tinify/lib/Tinify/Result.php");
require_once("vendor/tinify/tinify/lib/Tinify/Source.php");
require_once("vendor/tinify/tinify/lib/Tinify/Client.php");
require_once("vendor/tinify/tinify/lib/Tinify.php");

//require_once("vendor/autoload.php");
//\Tinify\setKeys("YOUR_API_KEY");
?>
<!doctype html>
<html lang="en">
<style>
    img{
        width:1500px;
    }

</style>
<head>
    <meta charset="UTF-8">
    <script>
        // Picture element HTML5 shiv
        document.createElement( "picture" );
    </script>

    <script src="https://cdn.rawgit.com/scottjehl/picturefill/3.0.2/dist/picturefill.min.js" async></script>
    <title>Document</title>
</head>
<body>

picture



<img class="lazy" data-original="test.jpg" alt="…">
<img class="lazy" data-original="test1.jpg" alt="…">
<img class="lazy" data-original="Copy.jpg" alt="…">




</body>
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<script src="jquery.lazyload.js">


</script>

<script>
    $(function() {
        $(".lazy").lazyload();
    });

</script>
</html>

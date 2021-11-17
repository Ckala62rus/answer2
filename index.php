<?php

require __DIR__ . '\ResizePNG.php';

/**
 * Debugger
 * @param $var
 */
function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

$filename = __DIR__ . '/image.png';
(new ResizePNG($filename, 200, 100, 9))->resizeImage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">
    <figure>
        <img src="/mini/test.png" alt="WatchApp">
    </figure>
</div>
</body>
</html>
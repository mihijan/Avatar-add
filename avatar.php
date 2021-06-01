<?php
require('libs/functions.php');

$file = $_POST['file'];
$x = (int)$_POST['x'];
$y = (int)$_POST['y'];

$extension = end(explode('.', $file));
$img_srs = create_src_image($extension, $file);
list($width, $height, $type, $attr) = getimagesize($file);
$size = $width >= $height ? $height : $width;
$img = imagecreatetruecolor($size, $size);
imagecopy($img, $img_srs, 0, 0, $x, $y, $size, $size);
create_dect_image($img, 'img/avatars/newImage.' . $extension, 100, $file);







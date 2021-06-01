<?php

function checkJpg($file)
{
    return preg_match('/.*\.jpg$/', $file) || preg_match('/.*\.jpeg$/', $file) || preg_match('/.*\.webp$/', $file) ? false: true;
}


function debag($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function create_src_image($extension, $file) 
{
    switch ($extension) {
        case "jpg":
            return imagecreatefromjpeg($file);
        case "jpeg":
            return imagecreatefromjpeg($file);
        case "gif":
            return imagecreatefromgif($file);
           
        case "webp":
            return imagecreatefromwebp($file);
        case "png":
            return imagecreatefrompng($file);
    }
}

function create_dect_image($img, $img_name, $quality, $delete_file = false) {
    if (imagejpeg($img, $img_name, $quality)) {
        if($delete_file) {
            unlink($delete_file);
        }
        echo 'Картинка обрезана удачно';
    } 
    else {
        echo 'Произошла ошибка';
    }
}






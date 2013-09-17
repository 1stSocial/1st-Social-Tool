<?php
    $output_width =80;
    $output_height=80;
 
    if(isset($_GET['height'])){
       $output_height=$_GET['height'];
    }
     if(isset($_GET['width'])){
       $output_width=$_GET['width'];
    }

   $path = ( (isset($_REQUEST['path']))? $_REQUEST['path'] : "");
   //echo  $path;exit;
    $size_arr = getimagesize($path);
    if ($size_arr[2]==IMAGETYPE_GIF)
        $image = imagecreatefromgif($path);
    else if ($size_arr[2]==IMAGETYPE_JPEG)
        $image = imagecreatefromjpeg($path);
    else if ($size_arr[2]==IMAGETYPE_PNG)
        $image = imagecreatefrompng($path);
    else
        die_default_image();

    $tmpname = tempnam( sys_get_temp_dir() , "phptmp");

    resize_image($tmpname, $image, $size_arr, $output_width, $output_height);

    header('Content-Type: image/jpg');
    header('Content-Disposition: inline; filename="'.basename($path).'"');
    echo file_get_contents( $tmpname );
    unlink( $tmpname );
    die('');


function die_default_image()
{
    //43byte 1x1 transparent pixel gif
    header("content-type: image/gif");
    echo base64_decode("R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");
}

function resize_image($thumbname, $image, $size_arr, $max_width, $max_height)//maintain aspect ratio
{
    $width  = $max_width;
    $height = $max_height;
    list($width_orig, $height_orig, $img_type) = $size_arr;
    $ratio_orig = $width_orig/$height_orig;

    if ($width/$height > $ratio_orig) {
       $width = floor($height*$ratio_orig);
    } else {
       $height = floor($width/$ratio_orig);
    }

    // Resample
    $tempimg = imagecreatetruecolor($width, $height);
    imagecopyresampled($tempimg, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    imagejpeg($tempimg, $thumbname, 80);
}

if (!function_exists('sys_get_temp_dir')) {
  function sys_get_temp_dir() {
    if (!empty($_ENV['TMP'])) { return realpath($_ENV['TMP']); }
    if (!empty($_ENV['TMPDIR'])) { return realpath( $_ENV['TMPDIR']); }
    if (!empty($_ENV['TEMP'])) { return realpath( $_ENV['TEMP']); }
    $tempfile=tempnam(uniqid(rand(),TRUE),'');
    if (file_exists($tempfile)) {
    unlink($tempfile);
    return realpath(dirname($tempfile));
    }
  }
}
?>
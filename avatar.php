<?php
include "blocks/db.php";

function getExtension($filename) {
    return array_pop(explode(".", $filename));
}

if (isset($_GET["id"]))
{
    $id = $_GET["id"];
    if (is_dir("images_users/".$id) == true)
    {
        $result = mysql_query("SELECT ava FROM users WHERE id='".$id."'", $db);
        $myrow  = mysql_fetch_array($result);
        $num    = mysql_num_rows($result);
        
        if ($myrow["ava"] != "")
        {
            if (getExtension($myrow["ava"]) == "png")
            {
                $image = ImageCreateFromPng("images_users/".$id."/".$myrow["ava"]);
            }
            if (getExtension($myrow["ava"]) == "jpeg" || getExtension($myrow["ava"]) == "jpg")
            {
                $image = ImageCreateFromJpeg("images_users/".$id."/".$myrow["ava"]);
            }
            if (getExtension($myrow["ava"]) == "gif")
            {
                $image = ImageCreateFromGif("images_users/".$id."/".$myrow["ava"]);
            }
            $image_width  = ImageSX($image);
            $image_height = ImageSY($image);
        
            $img = $image_width/160;
            $img2 = $image_width/160;
            $avatar_width  = $image_width/$img;
            $avatar_height = $image_height/$img;
            
            $avatar_image = ImageCreateTrueColor($avatar_width, $avatar_height);
            $white = imagecolorallocate($avatar_image, 255, 255, 255);
            ImageCopyResized($avatar_image, $image, 0, 0, 0, 0, $avatar_width, $avatar_height, $image_width, $image_height);
            imagefill($avatar_image, 160, 159, $white);
        
            header("Content-type: image/png");
            imagepng($avatar_image);
            ImageDestroy($image);
        }
        else
        {
            
        }
    }
}

?>
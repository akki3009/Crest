<?php
function createImage($images)
{
    global $original_height;
    global $original_width;
    global $imgt;
    global $imgcreatefrom;
    global $folder;
    global $fdir;
    global $images;
    global $directory;
    global $productdir;

    $folder = "uploads/category/thumbnail/";
    $productFolder = "uploads/product/thumbnail/";

    $images = $_FILES['category_image']['name'];
    $tempname = $_FILES['category_image']['tmp_name'];
    $images = time() . '-' . rand() . '-' . $images;
    $fdir = $folder . $images;
    $productdir = $productFolder . $images;
    $directory = "uploads/category/" . $images;
    $arr_image_details = getimagesize($tempname);

   $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($arr_image_details[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }

}
function createCategoryThumb($images)
{
    global $original_height;
    global $thumbnail_width;
    global $thumbnail_height;
    global $original_width;
    global $imgt;
    global $imgcreatefrom;
    global $fdir;
    $thumbnail_width = 100;
    $thumbnail_height = 100;
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }

    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

    if ($imgt) {
        $old_image = $imgcreatefrom($_FILES['category_image']['tmp_name']);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, $fdir);

    }
}

function cropCategoryImage($images)
{
    global $original_height;
    global $original_width;
    global $imgt;
    global $imgcreatefrom;

    global $directory;
    $full_width = 1024;
    $full_height = 720;
    if ($original_width > $original_height) {
        $new_width = $full_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $full_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }

    $dest_x = intval(($full_width - $new_width) / 2);
    $dest_y = intval(($full_height - $new_height) / 2);

    if ($imgt) {
        $old_image = $imgcreatefrom($_FILES['category_image']['tmp_name']);
        $new_image = imagecreatetruecolor($full_width, $full_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        // imagejpeg($new_image, $folder);
        $imgt($new_image, $directory);

    }
}
function productImage($images)
{
    global $images;
    global $tempFile;
    global $original_height;
    global $original_width;
    global $productdir;
    global $directory;
    global $imgt;
    global $imgcreatefrom;

    $productFolder = "uploads/product/thumbnail/";
    $productdir = $productFolder . $images;
    $directory = "uploads/product/" . $images;
    $arr_image_details = getimagesize($tempFile);
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];

    if ($arr_image_details[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
}
function createProductThumb($images)
{
    global $original_height;
    global $thumbnail_height;
    global $thumbnail_height;
    global $original_width;
    global $imgcreatefrom;
    global $imgt;
    global $key;
    global $productdir;
    $thumbnail_width = 100;
    $thumbnail_height = 100;
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }

    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

    if ($imgt) {
        $old_image = $imgcreatefrom($_FILES['image_name']['tmp_name'][$key]);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, $productdir);

    }
}
function cropProductImage($images)
{
    global $original_height;
    global $thumbnail_height;
    global $thumbnail_height;
    global $original_width;
    global $imgcreatefrom;
    global $imgt;
    global $key;
    global $directory;
    $thumbnail_width = 1024;
    $thumbnail_height = 720;
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }

    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

    if ($imgt) {
        $old_image = $imgcreatefrom($_FILES['image_name']['tmp_name'][$key]);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, $directory);

    }
}

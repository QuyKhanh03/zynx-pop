<?php

//upload image to public/images

if (!function_exists('uploadImage')) {
    function uploadImage($image, $path)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);
        return $imageName;
    }
}

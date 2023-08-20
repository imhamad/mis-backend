<?php

use Illuminate\Support\Str;

if (!function_exists('saveBase64Image')) {
    function saveBase64Image($base64Data, $directory, $filename)
    {
        // Remove the data URI scheme from the base64 string
        $base64Data = preg_replace('/^data:image\/\w+;base64,/', '', $base64Data);

        // Decode the base64 string to binary
        $imageBinary = base64_decode($base64Data);

        // Determine the destination path
        $destinationPath = public_path($directory) . DIRECTORY_SEPARATOR . $filename;

        // Save the image to the destination path
        file_put_contents($destinationPath, $imageBinary);

        // Construct the URL path without the domain
        $urlPath = $directory . '/' . $filename;

        // Return the URL of the saved image (without the domain)
        return $urlPath;
    }
}

if (!function_exists('imageUploader')) {
    function imageUploader($image, $slug)
    {
        $iconData = $image;
        $iconName = time() . rand(111, 999) . '-' . Str::slug($slug) . '.png';
        $iconDirectory = 'images';

        $url = saveBase64Image($iconData, $iconDirectory, $iconName);

        return $url;
    }
}

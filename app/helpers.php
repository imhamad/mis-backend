<?php

use Illuminate\Support\Str;

if (!function_exists('saveBase64Image')) {
    function saveBase64Image($base64Data, $directory, $filename)
    {
        $mime_type = mime_content_type($base64Data);

        if ($mime_type == 'image/svg+xml') {
            $base64Data = preg_replace('/^data:image\/svg\+xml;base64,/', '', $base64Data);
            $filename = $filename . '.' . 'svg';
        } else {
            $base64Data = preg_replace('/^data:image\/\w+;base64,/', '', $base64Data);
            $filename = $filename . '.' . 'png';
        }

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
        $iconName = time() . rand(111, 999) . '-' . Str::slug($slug);
        $iconDirectory = 'images';

        $url = saveBase64Image($iconData, $iconDirectory, $iconName);

        return $url;
    }
}

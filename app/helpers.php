<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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

if (!function_exists('generatePassword')) {
    function generatePassword($length = 8)
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()_+{}[]|:;<>,.?';

        $allCharacters = $uppercase . $lowercase . $numbers . $specialChars;

        // Shuffle the characters and get the first $length characters
        $password = substr(str_shuffle($allCharacters), 0, $length);

        // Ensure there is at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[' . preg_quote($specialChars, '/') . ']/', $password)) {
            // If the generated password doesn't meet the criteria, recursively call the function again
            return generatePassword($length);
        }

        return $password;
    }
}

if (!function_exists('saveUploadedVideo')) {
    function saveUploadedVideo($videoFile, $directory, $filename)
    {
        // Determine the destination path within the public folder
        $destinationPath = public_path($directory);

        // Move the uploaded file to the destination path with the specified filename
        $videoFile->move($destinationPath, $filename);

        // Construct the URL path without the domain
        $urlPath = $directory . '/' . $filename;

        // Return the URL of the saved video (without the domain) along with the file extension
        return $urlPath;
    }
}


if (!function_exists('videoUploader')) {
    function videoUploader($video, $slug)
    {
        $extension = $video->getClientOriginalExtension();

        // Generate a unique filename
        $videoName = time() . rand(111, 999) . '-' . Str::slug($slug) . '.' . $extension;

        // Specify the public folder for storing videos
        $videoDirectory = 'videos';

        // Call the saveUploadedVideo function to save the uploaded video
        $url = saveUploadedVideo($video, $videoDirectory, $videoName);

        return $url;
    }
}

if (!function_exists('baseURL')) {
    function baseURL($url)
    {
        return $url ? url($url) : null;
    }
}

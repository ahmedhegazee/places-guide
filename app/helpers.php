<?php

use Twilio\Rest\Client as RestClient;

// we add this file in the composer file
// add this section in the autoload section
/*
  "files": [
            "App/helpers.php"
        ],
 */
// to allow the class be defined in the loading of the application
function jsonResponse($status, $message, $data = null, $responseStatus = 200)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    return response()->json($response, $responseStatus, [], JSON_UNESCAPED_UNICODE);
}
function getHerokuDatabaseData($url)
{
    //heroku pgsql database guide
    //https://medium.com/@juangsalazprabowo/how-to-deploy-a-laravel-app-into-heroku-df55efbf8e4e
    //path is database name
    //add the config in the settings of app and don't change your database config file
    $DATABASE_URL = parse_url($url);
    $DATABASE_URL = array_merge($DATABASE_URL, ['path' => ltrim($DATABASE_URL['path'], '/')]);
    $dbName = $DATABASE_URL['path'];
    array_pop($DATABASE_URL);
    $DATABASE_URL['db_name'] = $dbName;
    return $DATABASE_URL;
}
function storeFile($file, $directory)
{
    $path = env('APP_URL') . '/storage/' . $file->store($directory, 'public');
    return $path;
}
function storeFileOnGoogleCloud($file, $directory)
{
    return env('GOOGLE_CLOUD_PUBLIC_URL') . $file->store($directory);
}
function deleteFile($file)
{
    $fileDirectory = public_path($file);
    if (file_exists($fileDirectory))
        unlink($fileDirectory);
}
function deleteFileOnFireBase($file)
{
}
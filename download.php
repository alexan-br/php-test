<?php
if (isset($_GET['file'])) {
    //get file name
    $fileName = $_GET['file'];
    //get file path
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . 'convertedFiles' . DIRECTORY_SEPARATOR . $fileName;
    //check if file exist
    if (file_exists($filePath)) {
        //set correct data for download

        //indicate media-type of our file to download
        header('Content-Type: application/json');

        //indicates that the file should be dowloaded and sets its basename
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');

        //read ou file that should be downloaded
        readfile($filePath);
        exit;
    } else {
        echo "File does not exist";
    }
} else {
    echo "Invalid request";
}

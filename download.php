<?php
if (isset($_GET['file'])) {
    //get file name
    $fileName = $_GET['file'];
    //get file path
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . 'convertedFiles' . DIRECTORY_SEPARATOR . $fileName;
    //check if file exist
    if (file_exists($filePath)) {
        //set correct data for download
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);
        exit;
    } else {
        echo "File does not exist";
    }
} else {
    echo "Invalid request";
}

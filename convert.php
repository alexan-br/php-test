<?php
if (isset($_FILES['fileUploaded'])) {
    //get uploaded file
    $file = $_FILES['fileUploaded']['tmp_name'];

    //get file name
    $fileName = $_FILES['fileUploaded']['name'];

    //get its content
    $fileContent = file_get_contents($file);

    //convert to array
    $array = array_map("str_getcsv", explode("\n", $fileContent));

    //convert to json
    $json = json_encode($array, JSON_PRETTY_PRINT);

    //set converted file name
    $jsonFileName = 'converted_' . $fileName . time() . '.json';

    //set converted files directory
    $jsonConvertedDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'convertedFiles';

    //set json saving path
    $jsonFilePath = $jsonConvertedDirectory . DIRECTORY_SEPARATOR . $jsonFileName;

    //put content in created json
    file_put_contents($jsonFilePath, $json);

    echo "<h1>Your converted file is ready !</h1>";

    echo "<a href='download.php?file=$jsonFileName'>Download JSON</a>";
} else {
    echo 'File not uploaded';
}

?>

<a href="/">Back to converter</a>
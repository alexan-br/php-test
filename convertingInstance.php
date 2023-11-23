<?php

class ConvertingInstance
{
    public $uploadedFile;
    public string $fileName;
    public string $filePath;
    public string $jsonFileName;

    public function convert($uploadedFile)
    {
        $xmlExension = array('xml');
        //get file name
        $this->fileName = $_FILES['fileUploaded']['name'];

        //get current file extension
        $currentFileExtension = pathinfo($this->fileName, PATHINFO_EXTENSION);

        //get its content
        $fileContent = file_get_contents($uploadedFile);

        if (in_array($currentFileExtension, $xmlExension)) {
            //convert to string xml data
            $xmlContent = simplexml_load_string($fileContent);

            //convert to json
            $json = json_encode($xmlContent, JSON_PRETTY_PRINT);
        } else {
            //convert to array
            $array = array_map("str_getcsv", explode("\n", $fileContent));

            //convert to json
            $json = json_encode($array, JSON_PRETTY_PRINT);
        }
        //set converted file name
        $this->jsonFileName = 'converted_' . $this->fileName . time() . '.json';

        //set converted files directory
        $jsonConvertedDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'convertedFiles';

        //set json saving path
        $jsonFilePath = $jsonConvertedDirectory . DIRECTORY_SEPARATOR . $this->jsonFileName;

        //put content in created json
        file_put_contents($jsonFilePath, $json);


        //displays page elements
        echo "<h1>Your converted file is ready !</h1>";
        echo "<a href='download.php?file=$this->jsonFileName'>Download JSON</a>";
    }
}

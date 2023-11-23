<?php
require_once 'ConvertingInstance.php';

if (isset($_FILES['fileUploaded'])) {
    $convert = new ConvertingInstance;
    $convert->convert($_FILES['fileUploaded']['tmp_name']);
} else {
    echo 'File not uploaded';
}

?>
<a href="/version-2" style="display: block;">Convert another file</a>
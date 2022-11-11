<?php

require 'inc/LibraryController.php';

$xml = null;
if (isset($_FILES['doc']) && ($_FILES['doc']['error'] == UPLOAD_ERR_OK)) {
    $xml = simplexml_load_file($_FILES['doc']['tmp_name']);
        $data = [];
    //var_dump($xml->book);

    $library = new LibraryController();

    $data = $library->xmlToArray($xml);
        print_r($library->store($data));



}


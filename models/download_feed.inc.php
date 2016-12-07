<?php

$testName = "Tester.xml";

$ch = curl_init();
$source = "http://mindfeed.esy.es/xml_downloads/123.xml";
$headers = get_headers($source, 1);

curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec ($ch);
curl_close ($ch);

$destination = "xml_downloads/" . $testName;
$file = fopen($destination, "w+");


if ($headers[0] == 'HTTP/1.1 200 OK') {
//valid 
    //test it
    print_r(get_headers($source, 1));
    
    //exec
    fputs($file, $data);
    fclose($file);

} elseif ($headers[0] == 'HTTP/1.1 404 Not Found'){
    echo "Error! This url cannot be retrived: Server response -> " .$headers[0];
}
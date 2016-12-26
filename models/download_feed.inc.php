<?php

$testName = "Tester.xml";

//curl and header
$ch = curl_init();
$source = "http://www.ilfattoquotidiano.it/feed/";
$headers = get_headers($source, 1);

//curl setup
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec ($ch);
curl_close ($ch);

//destination setup
$destination = "xml_downloads/" . $testName;

//XMLReader setup
$xml = XMLReader::open($source);
    // VALIDATE Option muss gesetzt werden, damit diese Methode ordnungsgemäß funktioniert
    $xml->setParserProperty(XMLReader::VALIDATE, true);


// URL is valid
if ($headers[0] == 'HTTP/1.1 200 OK' && $xml->isValid()) {
    //test it
    print_r(get_headers($source, 1));
    
    //exec
    $file = fopen($destination, "w+");
    fputs($file, $data);
    fclose($file);

} 
elseif ($headers[0] == 'HTTP/1.1 404 Not Found'){
    print_r("Error! This url cannot be retrived: Server response -> " .$headers[0]); 
}
<?php

$testName = "Tester.xml";

//curl and header
$ch = curl_init();
$source = "http://www.spiegel.de/politik/index.rss";
$headers = get_headers($source, 1);

//curl setup
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec ($ch);
curl_close ($ch);


//name
$file_name = preg_replace('#^https?://#', '', $source);
parse_url($file_name);
echo array(3)["host"];


//destination setup
$destination = "xml_downloads/" . $testName;


//XMLReader setup
$validator = "http://validator.w3.org/feed/check.cgi?url=".$source."&output=soap12";

$response = file_get_contents($validator);
$a = strpos($response, '<m:validity>', 0)+12; 
$b = strpos($response, '</m:validity>', $a); 
$result = substr($response, $a, $b-$a);

// URL is valid
if ($headers[0] == 'HTTP/1.1 200 OK' && $result == 'true') {
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
else{
    print_r("We're sorry this feed could not be processed!"); 
}
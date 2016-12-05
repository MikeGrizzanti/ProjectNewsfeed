<?php

$ch = curl_init();
$source = "";
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec ($ch);
curl_close ($ch);

$destination = "xml_downloads/";
$file = fopen($destination, "w+");
fputs($file, $data);
fclose($file);
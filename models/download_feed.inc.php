<?php
if ($_POST) {
    try {
        //curl and header
        $ch = curl_init();
        if (isset($_POST['add_feed'])) {
           $source = trim($_POST['add_feed']);
        }
        $headers = get_headers($source, 1);

        //curl setup
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec ($ch);
        curl_close ($ch);


        //name
        $file_name = preg_replace('#^https?://#', '', $source);
        $parsed_url = parse_url($source, PHP_URL_HOST);

        //destination setup
        $destination = "xml_downloads/" . $parsed_url;


        //XMLReader setup
        $validator = "http://validator.w3.org/feed/check.cgi?url=".$source."&output=soap12";

        $response = file_get_contents($validator);
        $a = strpos($response, '<m:validity>', 0)+12; 
        $b = strpos($response, '</m:validity>', $a); 
        $result = substr($response, $a, $b-$a);

        // URL is valid
        if ($headers[0] == 'HTTP/1.1 200 OK' && $result == 'true' || $headers[0] == 'HTTP/1.0 200 OK' && $result == 'true') {
                //exec
                $file = fopen($destination, "w+");
                fputs($file, $data);
                fclose($file);
        } 
        elseif ($headers[0] == 'HTTP/1.1 404 Not Found'){
            print_r("Error! This url cannot be retrived: Server response -> " .$headers[0]); 
        }
        elseif ($headers[0] =='HTTP/1.1 500 Internal Error'){
            print_r("We're sorry this feed could not be processed!" .$headers[0]); 
        }
        else {
            print_r("URL does not exist and/or couldn't be found");
        }
    } catch (Exception $ex) {
        print_r("Error: " .$ex);
    }
    
}
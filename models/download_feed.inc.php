<?php
if ($_POST) {
        //curl and header
        $ch = curl_init();
        if (isset($_POST['add_feed'])) {
           $source = trim($_POST['add_feed']);
        }
    
        //curl setup
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec ($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);


        //name
        $file_name = preg_replace('#^https?://#', '', $source);
        $parsed_url = parse_url($source, PHP_URL_HOST);

        //destination setup
        $destination = "xml_downloads/" . $parsed_url;


        // URL validations based on $retcode
        if ($retcode == 200 && $result == 'true') {
                //XMLReader init
                $validator = "http://validator.w3.org/feed/check.cgi?url=".$source."&output=soap12";

                $response = file_get_contents($validator);
                $a = strpos($response, '<m:validity>', 0)+12; 
                $b = strpos($response, '</m:validity>', $a); 
                $result = substr($response, $a, $b-$a);
            
                //exec
                $file = fopen($destination, "w+");
                fputs($file, $data);
                fclose($file);
        } 
    
        elseif ($retcode > 200 || $result == 'false'){
            print_r("Error! This url cannot be retrived or processed: Server response -> " .$retcode); 
        }
    
        else {
            print_r("URL does not exist and/or couldn't be found: Server response -> " .$retcode);
        }
    
}	
<?php
if ($_POST) {
        //curl and header
        $ch = curl_init();
        if (isset($_POST['add_feed']) && isset($_POST['member2'])) {
            $source = trim($_POST['add_feed']);
            $theme = trim($_POST['member2']);
            $_POST['member1'] = NULL;
        }
        
        elseif (isset($_POST['member1']) && isset($_POST['member2'])){
            $source_predefined = trim($_POST['member1']);
            $theme = trim($_POST['member2']);
            $_POST['add_feed'] = NULL;
        }
    
        //curl setup
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec ($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
    
        //XMLReader init
        $validator = "http://validator.w3.org/feed/check.cgi?url=".$source."&output=soap12";

        $response = file_get_contents($validator);
        $a = strpos($response, '<m:validity>', 0)+12; 
        $b = strpos($response, '</m:validity>', $a); 
        $result = substr($response, $a, $b-$a);
    
        //parse file via url and get the language before saving
        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));

        $xml = file_get_contents($source, false, $context);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
    
        //name
        $file_name = preg_replace('#^https?://#', '', $source);
        $parsed_url = parse_url($source, PHP_URL_HOST);

        //destination setup
        $destination = "xml_downloads/" . $parsed_url . "_" . $array[channel][language];
    

        // URL validations based on $retcode
        if ($retcode == 200 && $result == 'true') {
            
                //exec
                $file = fopen($destination, "w+");
                fputs($file, $data);
                fclose($file);
            
            
                //setup parser
                $rss =simplexml_load_file($destination);
                //print gettype($rss);
            
                $i = 0;
            
                 foreach($rss->channel->item as $item) {
                        if ($i < 100) { // parse only 100 items
                           $title_itm = $item->title;
                            $description_itm = $item->description;
                            //print '<a href="'.$item->link.'">'.$item->title.'</a><br />';
                            
                        }
                            $i++;
                }
            
                //this file is only meant to download the feed, parse it items via php_functions and save them into the db

                $feed_source = tb_category::getAllFeedSources();

                $statement = $link->prepare("INSERT INTO tb_feed (feed_id, feed_title, feed_content, feed_img_path, fk_category_id)
                    VALUES(?,?,?,?,?)");
                $statement->execute(array($i, $title_itm, $description_itm, "C:/jdd/gsgs", 10)); //insert parsed values here
            
        } 
    
        elseif ($retcode > 200 || $result == 'false'){
            echo "Error! This url cannot be retrived or processed: Server response -> " .$retcode; 
        }
    
        else {
            echo "URL does not exist and/or couldn't be found: Server response -> " .$retcode;
        }
    
}		
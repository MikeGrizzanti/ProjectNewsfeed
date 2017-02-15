<?php

include 'html2text-master/html2text.php';

if ($_POST) {
        //curl and header
        $ch = curl_init();
        if (isset($_POST['add_feed']) && isset($_POST['member2'])) {
            $source = trim($_POST['add_feed']);
            $theme = trim($_POST['member2']);
            $_POST['member1'] = NULL;
            
            //code...
        }
        
        elseif (isset($_POST['member1']) && isset($_POST['member2'])){
            $source_predefined = trim($_POST['member1']);
            $theme = trim($_POST['member2']);
            $_POST['add_feed'] = NULL;
            
            //code...
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
        /*$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));

        $xml = file_get_contents($source, false, $context);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);*/
    
        //name
    
        $info = parse_url($source);
        $host = $info['host'];
        $host_names = explode(".", $host);
    
        //destination setup
        $destination = "xml_downloads/" . $host_names[1] . ".xml";
        

        // URL validations based on $retcode
        if ($retcode == 200 && $result == 'true') {
            
                //exec
                $file = fopen($destination, "w+");
                fputs($file, $data);
                fclose($file);
            
            
                //setup parser
                $rss = simplexml_load_file($destination);
                //print gettype($rss);
            
                $i = 0;
            
                 foreach($rss->channel->item as $item) {
                        if ($i < 10) { // parse only 100 items
                            
                            $feed_attributes = [
                                'title' => $item->title, 
                                'description' => $item->description, 
                                'author' => $item->author, 
                                'pubDate' => $item->pubDate,
                                'guid' => $item->guid,
                                'image' => $item->image,
                            ];
                            
                            foreach ($feed_attributes as $key => $value) {
                                $text = convert_html_to_text($value);
                                $feed_attributes[$key] = $text;
                            }
                            
                           
                            
                            $sql = "INSERT INTO tb_feed (feed_title, feed_content, feed_author, feed_pubDate, feed_guid, feed_img_path, fk_category_id, fk_source_id) VALUES (?,?,?,?,?,?,?,?)";
                            $query = DB::getDB()->prepare($sql);
                            $query->execute(array($feed_attributes['title'], $feed_attributes['description'], $feed_attributes['author'], $feed_attributes['pubDate'], $feed_attributes['guid'], $feed_attributes['image'], 1, 1));
                            
                        }
                            $i++;
                }
        } 
    
        elseif ($retcode > 200 || $result == 'false'){
            echo "Error! This url cannot be retrived or processed: Server response -> " .$retcode; 
        }
    
        else {
            echo "URL does not exist and/or couldn't be found: Server response -> " .$retcode;
        }
    
}		
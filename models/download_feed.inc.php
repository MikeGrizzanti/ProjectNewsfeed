<?php

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
    
        //decodeHTMLent
        function decodeHtmlEnt($str) {
            $ret = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
            $p2 = -1;
            for(;;) {
                $p = strpos($ret, '&#', $p2+1);
                if ($p === FALSE)
                    break;
                $p2 = strpos($ret, ';', $p);
                if ($p2 === FALSE)
                    break;

                if (substr($ret, $p+2, 1) == 'x')
                    $char = hexdec(substr($ret, $p+3, $p2-$p-3));
                else
                    $char = intval(substr($ret, $p+2, $p2-$p-2));

                //echo "$char\n";
                $newchar = iconv(
                    'UCS-4', 'UTF-8',
                    chr(($char>>24)&0xFF).chr(($char>>16)&0xFF).chr(($char>>8)&0xFF).chr($char&0xFF) 
                );
                //echo "$newchar<$p<$p2<<\n";
                $ret = substr_replace($ret, $newchar, $p, 1+$p2-$p);
                $p2 = $p + strlen($newchar);
            }
            return $ret;
        }
    
        //name
    
        $info = parse_url($source);
        $host = $info['host'];
        $host_names = explode(".", $host);
    
        //destination setup
        $destination = "xml_downloads/" . $host_names[1] . ".xml";
        

        // URL validations based on $retcode
        if ($retcode == 200/* && $result == 'true'*/) {
            
                //exec
                $file = fopen($destination, "w+");
                fputs($file, $data);
                fclose($file);
            
            
                $sql_source = "INSERT INTO tb_source (source_name, source_path, fk_category_id) VALUES (?,?,?)";
                $query_source = DB::getDB()->prepare($sql_source);
                $query_source->execute(array($host_names[1], $source, $theme));
            
            
                $sql_source_id = "SELECT source_id FROM tb_source WHERE source_path LIKE 'http://www.ilfattoquotidiano.it/feed/'";
                $query_source_id = DB::getDB()->prepare($sql_source_id);
                $query_source_id->execute();
            
                
                $sql_interest = "INSERT INTO tb_user_interests (fk_user_id, fk_interests_id) VALUES (?,?)";
                $query_interest = DB::getDB()->prepare($sql_interest);
                $query_interest->execute(array($_SESSION['id'], $query_source_id));
            
            
            
                //setup parser
                $rss = simplexml_load_file($destination);
            
                $i = 0;
                $sql = "INSERT INTO tb_feed (feed_title, feed_content, feed_author, feed_pubDate, feed_guid, feed_img_path, fk_category_id, fk_source_id) VALUES (?,?,?,?,?,?,?,?)";
                $query = DB::getDB()->prepare($sql);
            
                 foreach($rss->channel->item as $item) {
                        if ($i < 10) { // parse only 100 items
                            
                            $feed_attributes = [
                                'title' => strip_tags(decodeHtmlEnt($item->title)), 
                                'description' => strip_tags(decodeHtmlEnt($item->description)), 
                                'author' => $item->author, 
                                'pubDate' => $item->pubDate,
                                'guid' => $item->guid,
                                'image' => $item->image,
                            ];
                            
                         
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
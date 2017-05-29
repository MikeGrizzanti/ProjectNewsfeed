<?php

require_once('entities/db.php');
require_once('entities/tb_source.php');

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

        if (isset($_POST) ){
       //curl and header
        //$ch = curl_init();
    
        
        if (isset($_POST['add_feed']) && isset($_POST['member2']) && $_POST['member1'] == "") {
            $source = trim($_POST['add_feed']);
            $theme = trim($_POST['member2']);
            $_POST['member1'] = NULL;
            
            $headers = get_headers($source, 1);
            session_start();        
    
        
        //XMLReader init
        /*$validator = "http://validator.w3.org/feed/check.cgi?url=".$source."&output=soap12";

        $response = file_get_contents($validator);
        $a = strpos($response, '<m:validity>', 0)+12; 
        $b = strpos($response, '</m:validity>', $a); 
        $result = substr($response, $a, $b-$a);*/
    
        //name
        $info = parse_url($source);
        $host = $info['host'];
        $host_names = explode(".", $host);
    
        //destination setup
        

        // URL validations based on $retcode
        if ($headers[0] == "HTTP/1.1 200 OK" || $headers[0] == "HTTP/1.0 200 OK") {
            
            
                if ($source != tb_source::checkIfSourceExists($source)) {
                    $sql_source = "INSERT INTO tb_source (source_name, source_path, fk_category_id) VALUES (?,?,?)";
                    $query_source = DB::getDB()->prepare($sql_source);
                    $query_source->execute(array($host_names[1], $source, $theme));


                    $sql_source_id = "SELECT source_id FROM tb_source WHERE source_path LIKE '".$source."'";
                    $query_source_id = DB::getDB()->prepare($sql_source_id);
                    $query_source_id->execute();   
                    $query_source_id->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
                    $fetch_source = $query_source_id->fetch()->getSourceId();


                    $sql_interest = "INSERT INTO tb_user_interests (fk_user_id, fk_interests_id) VALUES (?,?)";
                    $query_interest = DB::getDB()->prepare($sql_interest);
                    $query_interest->execute(array($_SESSION['id'], $fetch_source));
                    
                } 
                elseif ($source == tb_source::checkIfSourceExists($source)) {
                    $sql_source_id = "SELECT source_id FROM tb_source WHERE source_path LIKE '".$source."'";
                    $query_source_id = DB::getDB()->prepare($sql_source_id);
                    $query_source_id->execute();   
                    $query_source_id->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
                    $fetch_source = $query_source_id->fetch()->getSourceId();
                    
                    $sql_interest = "INSERT INTO tb_user_interests (fk_user_id, fk_interests_id) VALUES (?,?)";
                    $query_interest = DB::getDB()->prepare($sql_interest);
                    $query_interest->execute(array($_SESSION['id'], $fetch_source));
                }
                
                
                //setup parser
                //$rss = simplexml_load_file($destination);
            
            
                $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
                $rss = file_get_contents($source, true, $context);
                $rss = simplexml_load_string($rss, null, LIBXML_NOCDATA) or die("Error: Cannot load feed!");
            
                $i = 0;
                
                /*$time1 =  strtotime('Tue, 28 May 2013 09:31:30 GMT');
                $time2 =  strtotime('Tue, 28 May 2013 09:32:30 GMT');
                echo $timediff = abs($time2 -$time1);*/
            
                 foreach($rss->channel->item as $item) {
                        if ($i < 25) { // parse only 100 items
                            
                            $feed_attributes[] = array(
                                'title' => strip_tags(decodeHtmlEnt($item->title)), 
                                'description' => strip_tags(decodeHtmlEnt($item->description)), 
                                'author' => strip_tags($item->author), 
                                'pubDate' => strip_tags($item->pubDate),
                                'guid' => strip_tags($item->guid),
                                'image' => strip_tags($item->image),
                                'name' => $host_names,
                            );
                            
                            $sql = "INSERT INTO tb_feed (feed_title, feed_img_path, fk_category_id, feed_author,feed_pubDate, feed_guid, fk_source_id, feed_content) VALUES (?,?,?,?,?,?,?,?);";
                            $query = DB::getDB()->prepare($sql);
                            $query->execute(array(strip_tags(decodeHtmlEnt($item->title)), strip_tags($item->image), $theme, strip_tags($item->author), strip_tags($item->pubDate), strip_tags($item->guid), $fetch_source, strip_tags(decodeHtmlEnt($item->description))));
                        } 
                            $i++;
                }
            echo json_encode($feed_attributes, JSON_UNESCAPED_SLASHES);
        } 
    
        elseif ($headers[0] == "HTTP/1.1 200 OK" || $headers[0] == "HTTP/1.0 200 OK"){
            echo "Error! This url cannot be retrived or processed: Server response -> " .$headers[0]; 
        }
    
        else {
            echo "URL does not exist and/or couldn't be found: Server response -> " .$headers[0];
        }
                        
            
        }
        
        if (isset($_POST['member1']) && isset($_POST['member2']) && $_POST['add_feed'] == ""){
            $source_predefined = trim($_POST['member1']);
            $theme = trim($_POST['member2']);
            $_POST['add_feed'] = NULL;
            
            session_start();
            echo json_encode("here");
            
            $sql_source_id = "SELECT source_path FROM tb_source WHERE source_id = ? AND fk_category_id =?;";
            $query_source_id = DB::getDB()->prepare($sql_source_id);
            $query_source_id->execute(array($source_predefined, $theme));
            $query_source_id->setFetchMode(PDO::FETCH_CLASS, 'tb_source');
            $fetch_source = $query_source_id->fetchAll();
            

            
            $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
            $rss = file_get_contents($fetch_source, true, $context);
            $rss = simplexml_load_string($rss, null, LIBXML_NOERROR) or die("Error: Cannot create object");
            
            $i=0;
            
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
                        }
                            $i++;
                }
               echo json_encode($feed_attributes, JSON_UNESCAPED_SLASHES); 
        }
 
   } 
    
?>

		
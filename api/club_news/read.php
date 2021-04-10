<?php
        header("Content-Type:text/html; charset=utf-8");
        //compleyely public API(accessed by anybody not getting authorization or Tokens) 
        header('Access-Control-Allow-Origin: *');
        // accept Json which mime Tpye
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/club_news.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog news Object
        $news=new club_news($db);
        // Blog news query
        $result =$news->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $news_arr=array();
            
            // pagniation easily
            // $newss_arr['data']=array();

            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                // let key be the variable,take the content from sql
                extract($row);
                $news_item=array(

                    'club_name'=>$club_name,
                    'date'=>$date,
                    'news_title'=>$news_title,
                    'news_content'=>$news_content
                    
                );
                // Push to 'data'
                // array_push($newss_arr['data'],$news_item);
                // Turn to Json
                echo json_encode($news_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No user')
            );
        }
?>
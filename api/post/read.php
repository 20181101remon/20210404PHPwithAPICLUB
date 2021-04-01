<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/Post.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $post=new Post($db);
        // Blog post query
        $result =$post->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $post_arr=array();
            $posts_arr['data']=array();
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $post_item=array(
                    'id'=>$id,
                    'title'=>$title,
                    'body'=>html_entity_decode($body),
                    'category_id'=>$category_id,
                    'category_name'=>$category_name
                );
                // Push to 'data'
                array_push($posts_arr['data'],$post_item);
                // Turn to Json
                echo json_encode($posts_arr);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No Post')
            );
        }
?>
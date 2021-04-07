<?php
        header("Content-Type:text/html; charset=utf-8");
        //compleyely public API(accessed by anybody not getting authorization or Tokens) 
        header('Access-Control-Allow-Origin: *');
        // accept Json which mime Tpye
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $post=new User_info($db);
        // Blog post query
        $result =$post->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $post_arr=array();
            
            // pagniation easily
            // $posts_arr['data']=array();

            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                // let key be the variable,take the content from sql
                extract($row);
                $post_item=array(
                    'user_id'=>$user_id,
                    'user_password'=>$user_password,
                    'user_name'=>$user_name,
                    'user_sex'=>$user_sex,
                    'user_tel'=>$user_tel,
                    'user_mail'=>$user_mail
                );
                // Push to 'data'
                // array_push($posts_arr['data'],$post_item);
                // Turn to Json
                echo json_encode($post_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No Post')
            );
        }
?>
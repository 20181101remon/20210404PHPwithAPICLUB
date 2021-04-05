<?php
        header("Content-Type:text/html; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/financialtable.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $post=new financialtable($db);
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
                    'finance_summary'=>$finance_summary,
                    'finance_note'=>$finance_note,
                    'finance_income'=>$finance_income,
                    'finance_expenditure'=>$finance_expenditure,
                    'finance_balance'=>$finance_balance
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
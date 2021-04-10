<?php
        header("Content-Type:text/html; charset=utf-8");
        //compleyely public API(accessed by anybody not getting authorization or Tokens) 
        header('Access-Control-Allow-Origin: *');
        // accept Json which mime Tpye
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/feedback_type.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog user Object
        $feedback_type=new feedback_type($db);
        // Blog feedback_type query
        $result =$feedback_type->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $feedback_type_arr=array();
            
            // pagniation easily
            // $feedback_types_arr['data']=array();

            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                // let key be the variable,take the content from sql
                extract($row);
                $feedback_type_item=array(
                    'feedback_id'=>$feedback_id,
                    'feedback_name'=>$feedback_name
                );
                // Push to 'data'
                // array_push($feedback_types_arr['data'],$feedback_type_item);
                // Turn to Json
                echo json_encode($feedback_type_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No feedback_type')
            );
        }
?>
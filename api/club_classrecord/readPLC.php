<?php
        header("Content-Type:text/html; charset=utf-8");
        //compleyely public API(accessed by anybody not getting authorization or Tokens) 
        header('Access-Control-Allow-Origin: *');
        // accept Json which mime Tpye
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/club_classrecord.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog user Object
        $user=new club_classrecord($db);
        // Blog user query
        $result =$user->readPLC();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $user_arr=array();
            
            // pagniation easily
            // $users_arr['data']=array();

            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                // let key be the variable,take the content from sql
                extract($row);
                $user_item=array(
                    'date' => $date,
                    'club_name' => $club_name,
                    'club_teacher' => $club_teacher,
                    'class_place' => $class_place,
                    'class_contect' => $class_contect,
                    'pic' => $pic
                );
                // Push to 'data'
                // array_push($users_arr['data'],$user_item);
                // Turn to Json
                echo json_encode($user_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No user')
            );
        }
?>
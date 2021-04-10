<?php

// 撈取所有社團的資料(社團總攬)
        header("Content-Type:text/html; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/venue_lineup.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $venue=new venue_lineup($db);
        // Blog venue query
        $result =$venue->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $venue_arr=array();
            // $venues_arr['data']=array();
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $venue_item=array(
                    'club_name'=>$club_name,
                    'venue'=>$venue,
                    'date'=>$date,
                    'reason'=>$reason
                );
                // Push to 'data'
                // array_push($venue_arr['data'],$venue_item);
                // Turn to Json
                echo json_encode($venue_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No venue')
            );
        }
?>
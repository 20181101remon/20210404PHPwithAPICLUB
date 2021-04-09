<?php
        header("Content-Type:text/html; charset=utf-8");
        //compleyely public API(accessed by anybody not getting authorization or Tokens) 
        header('Access-Control-Allow-Origin: *');
        // accept Json which mime Tpye
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/activity_apply.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog activity_apply Object
        $activity_apply=new activity_apply($db);
        // Blog activity_apply query
        $result =$activity_apply->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $activity_apply_arr=array();
            
            // pagniation easily
            // $activity_applys_arr['data']=array();

            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                // let key be the variable,take the content from sql
                extract($row);
                $activity_apply_item=array(
                    'club_name'=>$club_name,
                    'activity_name'=>$activity_name,
                    'date'=>$date,
                    'activity_venue'=>$activity_venue,
                    'activity_mainpoint'=>$activity_mainpoint,
                    'organizer'=>$organizer,
                    'co_organizer'=>$co_organizer,
                    'source_of_funding'=>$source_of_funding,
                    'contact_person'=>$contact_person,
                    'contact_tel'=>$contact_tel,
                    'status_of_activity'=>$status_of_activity,
                    'review_note'=>$review_note

                );
                // Push to 'data'
                // array_push($activity_applys_arr['data'],$activity_apply_item);
                // Turn to Json
                echo json_encode($activity_apply_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No activity_apply')
            );
        }
?>
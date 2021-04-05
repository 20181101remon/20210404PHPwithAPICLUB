<?php
        header("Content-Type:text/html; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/club.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $club=new club_info($db);
        // Blog club query
        $result =$club->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $club_arr=array();
            $clubs_arr['data']=array();
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $club_item=array(
                    'club_id'=>$club_id,
                    'club_name'=>$club_name,
                    'club_type'=>$club_type,
                    'club_website'=>$club_website,
                    'club_purpose'=>$club_purpose,
                    'club_icon'=>$club_icon,
                    'club_introduce'=>$club_introduce,
                    'club_cover'=>$club_cover,
                    'club_place'=>$club_place,
                    'club_time'=>$club_time,
                    'status_of_club'=>$status_of_club,
                    'club_fee'=>$club_fee,
                    'club_teacher'=>$club_teacher,
                    'club_show_pic'=>$club_show_pic
                );
                // Push to 'data'
                array_push($clubs_arr['data'],$club_item);
                // Turn to Json
                echo json_encode($clubs_arr);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No club')
            );
        }
?>
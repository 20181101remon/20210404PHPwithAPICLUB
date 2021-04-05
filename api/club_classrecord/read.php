<?php
        // 某一個社團的所有社課但還是有小BUG
        header("Content-Type:text/html; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/club_classrecord.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $club=new club_classrecord($db);
        // Get ID
        $club->id = isset($_GET['id']) ? $_GET['id'] : die();  

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
                    'date'=>$date,
                    'club_name'=>$club_name,
                    'club_teacher'=>$club_teacher,
                    'class_place'=>$class_place,
                    'class_contect'=>$class_contect,
                    'pic'=>$pic
                    
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
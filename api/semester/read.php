<?php
        header("Content-Type:text/html; charset=utf-8");
        //compleyely public API(accessed by anybody not getting authorization or Tokens) 
        header('Access-Control-Allow-Origin: *');
        // accept Json which mime Tpye
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/semester.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog user Object
        $semester=new semester($db);
        // Blog semester query
        $result =$semester->read();
        // Get row Count
        $num=$result->rowCount();
        if($num>0){
            $semester_arr=array();
            
            // pagniation easily
            // $semesters_arr['data']=array();

            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                // let key be the variable,take the content from sql
                extract($row);
                $semester_item=array(
                    'semester_id'=>$semester_id,
                    'semester'=>$semester
                );
                // Push to 'data'
                // array_push($semesters_arr['data'],$semester_item);
                // Turn to Json
                echo json_encode($semester_item);
            }
        }else{
            echo json_encode(
                array('memessage'=>'No semester')
            );
        }
?>
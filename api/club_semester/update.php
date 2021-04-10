<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_semester.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $club_semester=new club_semester($db);

        // Get raw club_semestered data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $club_semester ->club_semester =$data ->club_semester ;
        $club_semester ->club_id =$data ->club_id;
        $club_semester ->semester_id =$data ->semester_id;
        $club_semester ->club_fee =$data ->club_fee;
        $club_semester ->club_teacher =$data ->club_teacher;
        $club_semester ->club_show_pic =$data ->club_show_pic;
        
        // create club_semester
        if($club_semester->update()){
            echo json_encode(
                array('message' => $club_semester)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'club_semester not Created')
            );
        }


?>



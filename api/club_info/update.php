<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $club=new club_info($db);

        // Get raw clubed data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $club ->club_id =$data ->club_id;
        $club ->club_name =$data ->club_name;
        $club ->club_type =$data ->club_type;
        $club ->club_website =$data ->club_website;
        $club ->club_purpose =$data ->club_purpose;
        $club ->club_icon =$data ->club_icon;
        $club ->club_introduce =$data ->club_introduce;
        $club ->club_cover =$data ->club_cover;
        $club ->club_place =$data ->club_place;
        $club ->club_time =$data ->club_time;
        $club ->source_of_funding =$data ->source_of_funding;
        $club ->status_of_club =$data ->status_of_club;

        // create club
        if($club->update()){
            echo json_encode(
                array('message' => $club)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'Post not Created')
            );
        }


?>



<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $user=new club_info($db);

        // Get raw usered data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $user ->club_id =$data ->club_id;
        $user ->club_name =$data ->club_name;
        $user ->club_type =$data ->club_type;
        $user ->club_website =$data ->club_website;
        $user ->club_purpose =$data ->club_purpose;
        $user ->club_icon =$data ->club_icon;
        $user ->club_introduce =$data ->club_introduce;
        $user ->club_cover =$data ->club_cover;
        $user ->club_place =$data ->club_place;
        $user ->club_time =$data ->club_time;
        $user ->source_of_funding =$data ->source_of_funding;
        $user ->status_of_club =$data ->status_of_club;

        // create user
        if($user->update()){
            echo json_encode(
                array('message' => $user)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'Post not Created')
            );
        }


?>



<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_planofsemester.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $user=new club_planofsemester($db);

        // Get raw usered data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $user ->flow_of_plan =$data ->flow_of_plan;
        $user ->date =$data ->date;
        $user ->activity_name =$data ->activity_name;
        $user ->club_semester =$data ->club_semester;
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



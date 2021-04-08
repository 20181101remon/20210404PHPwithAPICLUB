<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods:PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_classrecord.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $user=new club_classrecord($db);

        // Get raw usered data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $user ->flow_of_classrecord =$data ->flow_of_classrecord;
        $user ->date =$data ->date;
        $user ->class_name =$data ->class_name;
        $user ->class_teacher =$data ->class_teacher;
        $user ->class_place =$data ->class_place;
        $user ->class_contect =$data ->class_contect;
        $user ->updateAt =$data ->updateAt;
        $user ->PLC =$data ->PLC;
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



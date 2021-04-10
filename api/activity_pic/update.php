<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods:PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/activity_pic.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $activity_pic=new activity_pic($db);

        // Get raw activity_resultsed data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $activity_pic ->flow_of_pic =$data ->flow_of_pic;
        $activity_pic ->result_pic =$data ->result_pic;
        $activity_pic ->flow_result_activity =$data ->flow_result_activity;


        // create activity_pic
        if($activity_pic->update()){
            echo json_encode(
                array('message' => $activity_pic)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'activity_pic not Created')
            );
        }


?>



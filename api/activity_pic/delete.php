<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/activity_pic.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $activity_pic=new activity_pic($db);
        // Get raw activity_piced data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $activity_pic-> flow_of_pic =$data ->flow_of_pic;
        // DELETE activity_pic
        if($activity_pic->delete()){
            echo json_encode(
                array('message' => 'delete activity_pic ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'activity_pic not delete')
            );
        }


?>



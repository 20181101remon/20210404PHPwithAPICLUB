<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/activity_apply.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog activity_apply Object
        $activity_apply=new activity_apply($db);
        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $activity_apply-> flow_of_activity =$data ->flow_of_activity;
        // DELETE activity_apply
        if($activity_apply->delete()){
            echo json_encode(
                array('message' => 'delete activity_apply ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'activity_apply not delete')
            );
        }


?>



<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/activity_results.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $activity_results=new activity_results($db);
        // Get raw activity_resultsed data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $activity_results-> flow_result_activity =$data ->flow_result_activity;
        // DELETE activity_results
        if($activity_results->delete()){
            echo json_encode(
                array('message' => 'delete activity_results ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'activity_results not delete')
            );
        }


?>



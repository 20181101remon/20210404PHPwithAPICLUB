<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

        $activity_results ->flow_result_activity =$data ->flow_result_activity;
        $activity_results ->result_activity_population =$data ->result_activity_population;
        $activity_results ->achievement =$data ->achievement;
        $activity_results ->improvement =$data ->improvement;
        $activity_results ->flow_of_activity =$data ->flow_of_activity;


        // create activity_results
        if($activity_results->create()){
            echo json_encode(
                array('message' => $activity_results)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'activity_results not Created')
            );
        }

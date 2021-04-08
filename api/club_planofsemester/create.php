<?php 
  // Headers
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
        $club_plan=new club_planofsemester($db);

        // Get raw club_planed data
        $data =json_decode(file_get_contents("php://input"));

        $club_plan ->flow_of_plan =$data ->flow_of_plan;
        $club_plan ->date =$data ->date;
        $club_plan ->activity_name =$data ->activity_name;
        $club_plan ->club_semester =$data ->club_semester;


        // create club_plan
        if($club_plan->create()){
            echo json_encode(
                array('message' => $club_plan)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'club_plan not Created')
            );
        }

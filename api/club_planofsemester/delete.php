<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_planofsemester.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog club_plan Object
        $club_plan=new club_planofsemester($db);
        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $club_plan-> flow_of_plan =$data ->flow_of_plan;
        // DELETE club_plan
        if($club_plan->delete()){
            echo json_encode(
                array('message' => 'delete club_plan ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'club_plan not delete')
            );
        }


?>



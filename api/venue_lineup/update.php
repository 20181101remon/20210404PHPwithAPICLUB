<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/venue_lineup.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $venue=new venue_lineup($db);

        // Get raw venueed data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $venue ->flow_of_venue  =$data ->flow_of_venue ;
        $venue ->venue  =$data ->venue ;
        $venue ->date =$data ->date;
        $venue ->reason =$data ->reason;
        $venue ->club_semester =$data ->club_semester;
        // create venue
        if($venue->update()){
            echo json_encode(
                array('message' => $venue)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'venue not Created')
            );
        }


?>



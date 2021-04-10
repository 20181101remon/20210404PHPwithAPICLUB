<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/venue_lineup.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog venue Object
        $venue=new venue_lineup($db);
        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $venue-> flow_of_venue =$data ->flow_of_venue;
        // DELETE venue
        if($venue->delete()){
            echo json_encode(
                array('message' => 'delete venue ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'venue not delete')
            );
        }


?>



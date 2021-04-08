<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $club=new club_info($db);
        // Get raw clubed data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $club-> club_id =$data ->club_id;
        // DELETE club
        if($club->delete()){
            echo json_encode(
                array('message' => 'delete club ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'club not delete')
            );
        }


?>



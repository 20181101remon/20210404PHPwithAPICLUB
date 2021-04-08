<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_classrecord.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $classrecord=new club_classrecord($db);
        // Get raw classrecorded data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $classrecord-> flow_of_classrecord =$data ->flow_of_classrecord;
        // DELETE classrecord
        if($classrecord->delete()){
            echo json_encode(
                array('message' => 'delete classrecord ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'classrecord not delete')
            );
        }


?>



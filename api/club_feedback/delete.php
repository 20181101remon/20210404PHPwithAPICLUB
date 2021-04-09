<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_feedback.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog feedback Object
        $feedback=new club_feedback($db);
        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $feedback-> flow_of_feedback =$data ->flow_of_feedback;
        // DELETE feedback
        if($feedback->delete()){
            echo json_encode(
                array('message' => 'delete feedback ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'feedback not delete')
            );
        }


?>



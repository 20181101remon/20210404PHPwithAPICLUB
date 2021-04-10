<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/feedback_type.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog feedback_type Object
        $feedback_type=new feedback_type($db);
        // Get raw feedback_typeed data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $feedback_type-> feedback_id =$data ->feedback_id;
        // DELETE feedback_type
        if($feedback_type->delete()){
            echo json_encode(
                array('message' => 'delete feedback_type ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'feedback_type not delete')
            );
        }


?>



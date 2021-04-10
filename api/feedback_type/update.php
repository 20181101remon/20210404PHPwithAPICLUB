<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/feedback_type.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $feedback_type=new feedback_type($db);

        // Get raw feedback_typeed data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $feedback_type->feedback_id = $data->feedback_id;
        $feedback_type->feedback_name = $data->feedback_name;

        // create feedback_type
        if($feedback_type->update()){
            echo json_encode(
                array('message' => $feedback_type)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'feedback_type not Created')
            );
        }


?>



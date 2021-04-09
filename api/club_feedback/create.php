<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_feedback.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $feedback=new club_feedback($db);

        // Get raw club_planed data
        $data =json_decode(file_get_contents("php://input"));

        $feedback ->flow_of_feedback =$data ->flow_of_feedback;
        // $feedback ->date =$data ->date;
        $feedback ->content =$data ->content;
        $feedback ->club_id =$data ->club_id;
        $feedback ->feedback_id =$data ->feedback_id;


        // create feedback
        if($feedback->create()){
            echo json_encode(
                array('message' => $feedback)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'feedback not Created')
            );
        }

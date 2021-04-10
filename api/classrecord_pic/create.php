<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/classrecord_pic.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $classrecord_pic=new classrecord_pic($db);

        // Get raw activity_resultsed data
        $data =json_decode(file_get_contents("php://input"));

        $classrecord_pic ->flow_of_pic =$data ->flow_of_pic;
        $classrecord_pic ->pic =$data ->pic;
        $classrecord_pic ->flow_of_classrecord =$data ->flow_of_classrecord;
        // create classrecord_pic
        if($classrecord_pic->create()){
            echo json_encode(
                array('message' => $classrecord_pic)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'classrecord_pic not Created')
            );
        }

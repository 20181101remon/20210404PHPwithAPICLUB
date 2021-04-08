<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

        $classrecord ->flow_of_classrecord =$data ->flow_of_classrecord;
        $classrecord ->date =$data ->date;
        $classrecord ->class_name =$data ->class_name;
        $classrecord ->class_teacher =$data ->class_teacher;
        $classrecord ->class_place =$data ->class_place;
        $classrecord ->class_contect =$data ->class_contect;

        $classrecord ->PLC =$data ->PLC;
        $classrecord ->club_semester =$data ->club_semester;


        // create classrecord
        if($classrecord->create()){
            echo json_encode(
                array('message' => $classrecord)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'Post not Created')
            );
        }

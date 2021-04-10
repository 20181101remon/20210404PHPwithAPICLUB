<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/classrecord_pic.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $classrecord_pic=new classrecord_pic($db);
        // Get raw classrecord_piced data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $classrecord_pic-> flow_of_pic =$data ->flow_of_pic;
        // DELETE classrecord_pic
        if($classrecord_pic->delete()){
            echo json_encode(
                array('message' => 'delete classrecord_pic ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'classrecord_pic not delete')
            );
        }


?>



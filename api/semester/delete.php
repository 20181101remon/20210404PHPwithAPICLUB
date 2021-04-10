<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/semester.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog semester Object
        $semester=new semester($db);
        // Get raw semestered data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $semester-> semester_id =$data ->semester_id;
        // DELETE semester
        if($semester->delete()){
            echo json_encode(
                array('message' => 'delete semester ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'semester not delete')
            );
        }


?>



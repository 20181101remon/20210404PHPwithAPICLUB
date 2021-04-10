<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_semester.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $club_semester=new club_semester($db);
        // Get raw club_semestered data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $club_semester-> club_semester =$data ->club_semester;
        // DELETE club_semester
        if($club_semester->delete()){
            echo json_encode(
                array('message' => 'delete club_semester ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'club_semester not delete')
            );
        }


?>



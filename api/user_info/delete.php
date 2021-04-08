<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog user Object
        $user=new User_info($db);
        // Get raw usered data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $user-> user_id =$data ->user_id;
        // DELETE user
        if($user->delete()){
            echo json_encode(
                array('message' => 'delete user ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'user not delete')
            );
        }


?>



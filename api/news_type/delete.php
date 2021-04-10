<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/news_type.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog news_type Object
        $news_type=new news_type($db);
        // Get raw news_typeed data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $news_type-> news_id =$data ->news_id;
        // DELETE news_type
        if($news_type->delete()){
            echo json_encode(
                array('message' => 'delete news_type ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'news_type not delete')
            );
        }


?>



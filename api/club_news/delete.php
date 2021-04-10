<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/club_news.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog news Object
        $news=new club_news($db);
        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $news-> flow_of_news =$data ->flow_of_news;
        // DELETE news
        if($news->delete()){
            echo json_encode(
                array('message' => 'delete news ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'news not delete')
            );
        }


?>



<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/news_attend_file.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $news_attend_file=new news_attend_file($db);
        // Get raw news_attend_fileed data
        $data =json_decode(file_get_contents("php://input"));
        // Set id to update
        $news_attend_file-> flow_of_file =$data ->flow_of_file;
        // DELETE news_attend_file
        if($news_attend_file->delete()){
            echo json_encode(
                array('message' => 'delete news_attend_file ')
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'news_attend_file not delete')
            );
        }


?>



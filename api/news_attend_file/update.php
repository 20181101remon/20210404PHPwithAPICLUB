<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods:PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/news_attend_file.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $news_attend_file=new news_attend_file($db);

        // Get raw activity_resultsed data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $news_attend_file ->flow_of_news =$data ->flow_of_news;
        $news_attend_file ->flow_of_file =$data ->flow_of_file;
        $news_attend_file ->news_pic =$data ->news_pic;
        $news_attend_file ->news_file =$data ->news_file;
        
        // create news_attend_file
        if($news_attend_file->update()){
            echo json_encode(
                array('message' => $news_attend_file)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'news_attend_file not Created')
            );
        }


?>



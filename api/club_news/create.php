<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    include_once '../../config/Database.php';
    include_once '../../models/club_news.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $news=new club_news($db);

        // Get raw newsed data
        $data =json_decode(file_get_contents("php://input"));

        $news ->flow_of_news =$data ->flow_of_news;
        $news ->news_title =$data ->news_title;
        $news ->news_content =$data ->news_content;
        $news ->date =$data ->date;
        $news ->PLC =$data ->PLC;
        $news ->updateAt =$data ->updateAt;
        $news ->news_id =$data ->news_id;
        $news ->club_id =$data ->club_id;


        // create news
        if($news->create()){
            echo json_encode(
                array('message' => $news)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'news not Created')
            );
        }

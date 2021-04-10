<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/news_type.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $news_type=new news_type($db);

        // Get raw news_typeed data
        $data =json_decode(file_get_contents("php://input"));

        // SET ID 
        $news_type->news_id = $data->news_id;
        $news_type->news_name = $data->news_name;

        // create news_type
        if($news_type->update()){
            echo json_encode(
                array('message' => $news_type)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'news_type not Created')
            );
        }


?>



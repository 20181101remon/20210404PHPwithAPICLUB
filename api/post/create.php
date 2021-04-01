<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Accress-Control-Allow-Headers:Accress-Control-Allow-Headers,Content-Type,
        Access-Control-Allow-Methods,Authorization,X-Requseted-With');
        include_once '../../config/Database.php';
        include_once '../../models/Post.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $post=new Post($db);

        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));

        $post ->title =$data ->title;
        $post ->body =$data ->body;
        $post ->author =$data ->author;
        $post ->category_id =$data ->category_id;
        // create post

        if($post->create()){
            echo json_encode(
                array('message' => 'Post Created')
            );

        }
        else
        {
            echo json_encode(
                array('message' => 'Post not Created')
            );
        }


?>



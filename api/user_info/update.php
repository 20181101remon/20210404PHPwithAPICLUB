<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $post=new User_info($db);

        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"));

        // Set id to update
        $post-> user_id =$data ->user_id;
        $post ->user_password =$data ->user_password;
        $post ->user_name =$data ->user_name;
        $post ->user_sex =$data ->user_sex;
        $post ->user_tel =$data ->user_tel;
        $post ->user_mail =$data ->user_mail;
        // Update post

        if($post->update()){
            echo json_encode(
                array('message' => 'Update Post ')
            );

        }
        else
        {
            echo json_encode(
                array('message' => 'Post not Updated')
            );
        }


?>



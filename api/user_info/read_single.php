<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object

        $post=new User_info($db);
        

        // Get ID
        $post->id = isset($_GET['id']) ? $_GET['id'] : die();

        // Get Post 
        $post->read_single();

        // create array

        $post_arr =array(
        'user_id' => $post->user_id,
        'user_password' => $post->user_password,
        'body' => $post -> body,
        'user_name' => $post ->user_name,
        'user_sex' => $post -> user_sex,
        'user_tel' => $post -> user_tel,
        'user_mail' => $post -> user_mail

        );

        //Make Json
        print_r(json_encode($post_arr));

?>
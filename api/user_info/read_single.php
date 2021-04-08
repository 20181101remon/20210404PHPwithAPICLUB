<?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog user Object

        $user=new User_info($db);
        

        // Get ID
        $user->id = isset($_GET['id']) ? $_GET['id'] : die();

        // Get user 
        $user->read_single();

        // create array

        $user_arr =array(
        'user_id' => $user->user_id,
        'user_password' => $user->user_password,
        'body' => $user -> body,
        'user_name' => $user ->user_name,
        'user_sex' => $user -> user_sex,
        'user_tel' => $user -> user_tel,
        'user_mail' => $user -> user_mail

        );

        //Make Json
        print_r(json_encode($user_arr));

?>
<?php
// 失敗
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        header('Access-Control-Allow-Methods: POST');
        // header('encoding-type: application/x-www-form-urlencoded');
        header('Accress-Control-Allow-Headers:Accress-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requseted-With');
        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $user_info=new User_info($db);
        // Get raw posted data
        $data =json_decode(file_get_contents("php://input"), true);

        $user_info ->user_id =$data ->user_id;
        $user_info ->user_password =$data ->user_password;
        $user_info ->user_name =$data ->user_name;
        $user_info ->user_sex =$data ->user_sex;
        $user_info ->user_tel =$data ->user_tel;
        $user_info ->user_mail =$data ->user_mail;
        $user_info ->user_pic =$data ->user_pic;
        // create post

        if($user_info->create()){
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



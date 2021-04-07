<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/user_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $user=new User_info($db);

        // Get raw usered data
        $data =json_decode(file_get_contents("php://input"));

        $user ->user_id =$data ->user_id;
        $user ->user_password =$data ->user_password;
        $user ->user_name =$data ->user_name;
        $user ->user_sex =$data ->user_sex;
        $user ->user_tel =$data ->user_tel;

        // create user
        if($user->create()){
            echo json_encode(
                array('message' => $user)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'Post not Created')
            );
        }

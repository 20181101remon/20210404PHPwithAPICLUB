<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        include_once '../../config/Database.php';
        include_once '../../models/financialtable.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $financialtable=new financialtable($db);

        // Get raw financialtableed data
        $data =json_decode(file_get_contents("php://input"));

        $financialtable ->flow_of_financercord =$data ->flow_of_financercord ;
        $financialtable ->date =$data ->date;
        $financialtable ->finance_summary =$data ->finance_summary;
        $financialtable ->finance_note =$data ->finance_note;
        $financialtable ->finance_income =$data ->finance_income;
        $financialtable ->finance_expenditure =$data ->finance_expenditure;
        $financialtable ->finance_balance =$data ->finance_balance;
        $financialtable ->club_semester  =$data ->club_semester ;

        // create financialtable
        if($financialtable->create()){
            echo json_encode(
                array('message' => $financialtable)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'financialtable not Created')
            );
        }

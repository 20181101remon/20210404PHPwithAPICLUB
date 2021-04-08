<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/financialtable.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog financialtable Object

$financialtable = new financialtable($db);


// Get ID
$financialtable->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get financialtable 
$result = $financialtable->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        $financialtable_arr = array();

        // pagniation easily
        // $financialtables_arr['data']=array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $financialtable_item = array(
                        'date'=>$date,
                        'finance_summary'=>$finance_summary,
                        'finance_note'=>$finance_note,
                        'finance_income'=>$finance_income,
                        'finance_expenditure'=>$finance_expenditure,
                        'finance_balance'=>$finance_balance
                        
                );
                // Push to 'data'
                // array_push($financialtables_arr['data'],$financialtable_item);
                // Turn to Json
                echo json_encode($financialtable_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No financialtable')
        );
}

//Make Json
print_r(json_encode($financialtable_arr));

<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/27/2018
 * Time: 1:39 AM
 */
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include 'controller/action.php';

$last_line = "";
exec('sudo python seread.py', $last_line);
$card_no = implode("",$last_line);
// Printing additional info
//$_SESSION['card_no'] = $last_line;
//$card_no = $last_line;
//$card_no = "123456";
exec('sudo killall python');
$value = custom_query("SELECT * FROM tbl_client WHERE card_no = '$card_no' ORDER BY ID DESC");
if($value->rowCount()>0)
{
    while($row=$value->fetch(PDO::FETCH_ASSOC)) {
        $data = array(
            "card_no"=>$row['card_no'],
            "full_name"=>$row['firstname'] . " ". $row['lastname'],
            "card_load"=>$row['card_load'],
            "type"=>$row['type']
        );
    }
    echo json_encode($data);
}
else {
    $data = array("title"=>"Error",
        "Message"=>"User is Not Registered"
    );
    echo json_encode($data);
}


?>

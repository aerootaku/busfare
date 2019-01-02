<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 9/19/2018
 * Time: 9:39 AM
 */

include 'controller/action.php';
header('Content-Type: application/json');

if(isset($_GET['loc_to'])){
    $loc_to = $_GET['loc_to'];
    $loc_from = $_GET['loc_from'];
    $value = custom_query("SELECT * FROM tbl_location WHERE loc_from = '$loc_from' and loc_to = '$loc_to' ORDER BY id DESC");
    if($value->rowCount()>0) {
        while ($r = $value->fetch(PDO::FETCH_ASSOC)) {
            $result = array(
                'fee'=>$r['fee']
            );
        }
        echo json_encode($result);
    }

}
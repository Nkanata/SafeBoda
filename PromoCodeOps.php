<?php
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $promoDetails = json_decode($json);

    $active = $promoDetails->active;
    $all = $promoDetails->all;
    $deactivate = $promoDetails->deactivate;
    $promoCode = $promoDetails->promocode;

    if(isset($deactivate) && isset($promoCode)){
        $deactivate = "UPDATE promo_codes set status = 'inactive' where `promo_code` = '$promoCode'";
        if ($db->query($deactivate)===TRUE){
            echo "Promo code $promoCode has been deactivated";
        }else{
            echo $db->error;
            echo "Error occured $db->error" ;
        }
    }

}
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $getAll = $_GET["getall"];
    $getActive = $_GET["getactive"];

    if (isset($getAll)){
        $get_all = "SELECT * from promo_codes";
        $result = $db->query($get_all);

        if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
            //print_r($row);
            //echo $result->num_rows;
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
           // $data = array_values($row);
            $data = json_encode($data);

            echo $data;
            
        }

    }
    if (isset($getActive)){
        $get_all_active = "SELECT * from promo_codes where status = 'active'";
        $result = $db->query($get_all_active);

        if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
           // $data = array_values($row);
            $data = json_encode($data);

            echo $data;
            
        }
    }

}

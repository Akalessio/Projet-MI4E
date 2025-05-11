<?php
session_start();

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header("Location:login.php");
    exit();
}

if(isset($_SESSION['new_trip'])) {
    $new_trip = $_SESSION['new_trip'];
}else{
    die('error trip informations not saved');
}

if(isset($_SESSION['current_trip'])) {
    $current_trip = $_SESSION['current_trip'];
}else{
    die('error trip informations not saved');
}

$basket_path = 'data/trip_file/basket_' . $_SESSION['user']['trip_file'];

if(!file_exists($basket_path)){
    file_put_contents($basket_path, json_encode([]));
}

$basket_list = json_decode(file_get_contents($basket_path), true);

$error=false;

$start_date = new DateTime($new_trip['start_date']);
$end_date= new DateTime($new_trip['end_date']);


foreach ($basket_list as $reservation){

    $res_start = new DateTime($reservation['start_date']);
    $res_end = new DateTime($reservation['end_date']);

    if (($start_date > $res_start && $start_date < $res_end) ||
        ($end_date > $res_start && $end_date < $res_end) ||
        ($start_date < $res_start && $end_date > $res_end) ||
        ($start_date == $res_start && $end_date == $res_end)) {
        $error = true;
    }
}

if($error){
    die("you already have a trip on this period of time in the basket");
}

$basket_list[]=$new_trip;

file_put_contents($basket_path, json_encode($basket_list, JSON_PRETTY_PRINT));

header("Location:../../basket.php");
exit();
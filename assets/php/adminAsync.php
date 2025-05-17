<?php
session_start();
sleep(2);
function userDetection(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if(!userDetection()){
    header('Location: ../../index.php');
    exit();
}

if ($_SESSION['user']['rank'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'You do not have permission to perform this action']);
    exit();
}


$user = $_SESSION['user'];
$user_list='data/user_list.json';
$headers = array_change_key_case(getallheaders(), CASE_LOWER);
$user_found=false;
if(isset($headers['mail'])){
    $mail=$headers['mail'];
}else{
    http_response_code(401);
    echo json_encode(['error' => 'Mail not found']);
    exit();
}
if (isset($_GET['action'])){
    $action=$_GET['action'];
}else{
    http_response_code(401);
    echo json_encode(['error' => 'Action not found']);
    exit();
}

if(file_exists($user_list)){
    $registred_user=json_decode(file_get_contents($user_list), true);
    if($registred_user == null){
        http_response_code(403);
        echo json_encode(['error' => 'User not found']);
        exit();
    }
}else{
    http_response_code(403);
    echo json_encode(['error' => 'UserList not found']);
    exit();
}

    $rank='';
    $discount='';

    switch ($action) {
        case "add_admin":
            $rank="admin";
            break;
        case "unban_account":
        case "remove_admin":
            $rank='user';
            break;
        case "add_vip":
            $rank="vip";
            break;
        case "ban_account":
            $rank="ban";
            break;
        case "free_trip":
            $discount="100";
            break;
        default:
            http_response_code(401);
            echo json_encode(['error' => 'Action not found']);
            exit();
            break;
    }



    foreach ($registred_user as &$user_read) {
        if($user_read['mail']==$mail && $user_read['rank']=="admin" && $action == "add_vip"){
            http_response_code(200);
            echo json_encode(['error' => 'cant add vip rank to an admin account']);
            exit();
        }if($user_read['mail']==$mail && $user_read['rank']!="ban" && $action == "unban_account"){
            http_response_code(200);
            echo json_encode(['error' => 'This account is already not ban']);
            exit();
        }
        if($user_read['mail']==$mail AND $rank!=''){
            $user_read['rank']=$rank;
        }
        if($user_read['mail']==$mail AND $discount!=''){
            $user_read['discount']=$discount;
        }
    }

    unset($user_read);

    if($_SESSION['user']['mail']==$mail){
        if($rank!='')$_SESSION['user']['rank']=$rank;
        if($discount!='')$_SESSION['user']['discount']=$discount;
    }
    if(file_put_contents($user_list, json_encode($registred_user, JSON_PRETTY_PRINT)) === false){
        die('Error writing to file');
    }

    http_response_code(200);
    echo json_encode(['success' => 'User change successfully']);
    exit();



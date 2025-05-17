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

if (!isset($_GET['field'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No field specified.']);
    exit();
}

$field = $_GET['field'];
$headers = array_change_key_case(getallheaders(), CASE_LOWER);


    $fname=$_SESSION['user']['fname'];
    $lname=$_SESSION['user']['lname'];
    $date=$_SESSION['user']['date'];
    $mail=$_SESSION['user']['mail'];
    $profile_picture=$_SESSION['user']['profile_picture'];
    $password=$_SESSION["user"]["password"];

    switch ($field) {
        case 'firstname':
            $fname=$headers['current'];
            break;
        case 'lastname':
            $lname=$headers['current'];
            break;
        case 'date':
            $date=$headers['current'];
            break;
        case 'email':
            $mail=$headers['current'];
            break;
        case 'profile_picture_select':
            $profile_picture=$headers['current'];
            break;
        case 'password':
            if(!password_verify($headers['current'],$_SESSION["user"]["password"])){
                $password=password_hash($headers['current'],PASSWORD_DEFAULT);
            }
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'No field specified.']);
            exit();
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid date format.']);
        exit();
    }

    $timestamp = strtotime($date);
    if (!$timestamp) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid date format.']);
        exit();
    }

    if ($timestamp > time()) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid date format.']);
        exit();
    }

    if(!$mail || !filter_var($mail, FILTER_VALIDATE_EMAIL)){
        http_response_code(400);
        echo json_encode(['error' => 'No email or invalid address specified.']);
        exit();
    }


    if(empty($password)){
        http_response_code(400);
        echo json_encode(['error' => 'No password specified.']);
        exit();
    }

    $user_file = "assets/php/data/user_list.json";

    if (file_exists($user_file)) {
        $registered_user = json_decode(file_get_contents($user_file), true);
        if($registered_user == null){
            http_response_code(400);
            echo json_encode(['error' => 'User not found.']);
            die("Unable to load user file");
        }
    }else{
        http_response_code(400);
        echo json_encode(['error' => 'UserFile not found.']);
        die();
    }

    foreach ($registered_user as $new_user) {
        if($new_user['mail']==$mail && $field == "email" && $new_user['mail'] != $_SESSION['user']['mail']){
            http_response_code(400);
            echo json_encode(['error' => 'Mail already in use.']);
            exit();
        }
    }

    foreach ($registered_user as &$new_user) {
        if($new_user["mail"]==$_SESSION['user']['mail']){
            $new_user = [ "lname" => $lname, "fname" => $fname, "date" => $date, "mail" => $mail, "password" => $password, "rank" => $new_user['rank'], "discount" => $new_user["discount"], "profile_picture" => $profile_picture, "trip_file" => $new_user['trip_file'] ] ;
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['user']['fname'] = $fname;
            $_SESSION['user']['lname'] = $lname;
            $_SESSION['user']['date'] = $date;
            $_SESSION['user']['password'] = $password;
            $_SESSION['user']['profile_picture'] = $profile_picture;
        }
    }

    if (file_put_contents($user_file, json_encode($registered_user, JSON_PRETTY_PRINT)) === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Unable to write to file.']);
        exit();
    }



    echo json_encode(['success' => 'User successfully modified.']);
    exit();



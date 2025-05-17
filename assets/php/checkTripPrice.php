<?php

function userDetection(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if(!userDetection()){
    header('Location: ../../index.php');
    exit();
}

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid Trip Id"]);
    exit();
}

$id = $_GET['id'];
$trips = json_decode(file_get_contents("data/trip_list.json"), true);

foreach ($trips as $trip) {
    if ($trip['trip_id'] == $id) {
        header('Content-type: application/json');
        echo json_encode($trip);
        exit();
    }
}

http_response_code(404);
echo json_encode(["error" => "voyage non trouvé dans le fichier (id incohérent)"]);
<?php
session_start();

if (!isset($_POST['trip_id']) || !isset($_SESSION['user'])) {
    http_response_code(400);
    echo 'missing data';
    exit;
}

$trip_id = $_POST['trip_id'];
$basket_path = 'data/trip_file/basket_' . $_SESSION['user']['trip_file'];

if (!file_exists($basket_path)) {
    http_response_code(404);
    echo 'file not found';
    exit;
}

$basket = json_decode(file_get_contents($basket_path), true);

$updated_basket = array_filter($basket, function($trip) use ($trip_id) {
    return $trip['trip_id'] !== $trip_id;
});

if (file_put_contents($basket_path, json_encode(array_values($updated_basket), JSON_PRETTY_PRINT)) === false) {
    http_response_code(500);
    echo 'write error';
    exit;
}

http_response_code(200);
echo 'success';



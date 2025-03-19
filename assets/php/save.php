<?php
session_start();

$user = $_SESSION['user'];

if (isset($_GET['status'])) {
    $id = $_GET['status'];
    if ($id == 'accepted') {
        $trip_file = 'assets/php/data/trip_file/' . $_SESSION['user']['trip_file'];

        if (file_exists($trip_file)) {
            $trip = json_decode(file_get_contents($trip_file), true);
            $trip[] = $_SESSION['new_trip'];
            if (file_put_contents($trip_file, json_encode($trip, JSON_PRETTY_PRINT)) === false) {
                die("Error writing to file.");
            }
        }
    }
}


    header("Location:../../profile.php");
    exit();










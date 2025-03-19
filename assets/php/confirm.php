<?php

session_start();

if (!isset($_SESSION['user'])) {
    die('you must be logged');
}

if (!isset($_SESSION['current_trip'])) {
    die('trip informations error');
}

if (!isset($_SESSION['new_trip'])) {
    die('trip informations error');
}

$trip_file = 'assets/php/data/trip_file/' . $_SESSION['user']['trip_file'];

require('getapikey.php');

$apikey = 'zzzz';
$seller='MI-4_E';
$apikey = getAPIKey($seller);
function generateTransactionID($length = 12) {
    return substr(bin2hex(random_bytes($length)), 0, $length);
}

$transaction_id = generateTransactionID();
$back = "http://localhost:9000/profile.php";

$control = md5($apikey . "#" . $transaction_id . "#" . (int)$_SESSION['new_trip']['price'] . "#" . $seller . "#" . $back . "#");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link  rel="stylesheet" href="https://db.onlinewebfonts.com/c/485fe91395665a0ac50e25744ff3a19c?family=Get+Schwifty">
</head>
<body style="width: 100%; margin: 0; padding: 0; background: #DCDFDA">
<form action="https://www.plateforme-smc.fr/cybank/index.php" method="post">

    <input type='hidden' name='transaction'
           value='<?= $transaction_id ?>'>

    <input type='hidden' name='montant' value='<?php
        $montant = (int)$_SESSION['new_trip']['price'];
        echo $montant;
    ?>'>

    <input type='hidden' name='vendeur' value='<?= $seller ?>'>

    <input type='hidden' name='retour'

           value='<?= $back ?>'>

    <input type='hidden' name='control'
           value='<?= $control ?>'>

    <input type='submit' value="Valid and Pay">

</form>
</html>

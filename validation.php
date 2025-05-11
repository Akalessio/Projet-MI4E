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

require('assets/php/getapikey.php');

$apikey = 'zzzz';
$seller='MI-4_E';
$apikey = getAPIKey($seller);
function generateTransactionID($length = 12) {
    return substr(bin2hex(random_bytes($length)), 0, $length);
}

$transaction_id = generateTransactionID();
$back = "http://localhost:9000/solded.php";

$control = md5($apikey . "#" . $transaction_id . "#" . (int)$_SESSION['new_trip']['price'] . "#" . $seller . "#" . $back . "#");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/book.css">
    <link rel="stylesheet" href="assets/css/triplist.css">
    <link  rel="stylesheet" href="https://db.onlinewebfonts.com/c/485fe91395665a0ac50e25744ff3a19c?family=Get+Schwifty">
    <script src="assets/js/main.js" defer></script>
</head>
<body style="width: 100%; margin: 0; padding: 0;">
<div class="site-header">
    <div class="title">
        <h2>
            <a href="index.php">
                <span style=" font-family: 'Get Schwifty', sans-serif;
                font-size: 48px;
                font-weight: bold;
                color: #DCDFDA;
                display: inline-block">
                    Dimension'
                </span><span style=" font-family: 'Get Schwifty', sans-serif;
                font-size: 48px;
                font-weight: bold;
                color:#8FB43A;
                display: inline-block">
                    Trip
                </span>
            </a>
        </h2>
    </div>
    <div class="right-icon">

        <div class="search-bar">
            <input type="text" placeholder="Search">
            <a href="#">
                <i class="fas fa-search"></i>
            </a>
        </div>
        <a href="triplist.php" class="mid-link-item">
            Book a trip
        </a>
        <a href="#contact" class="mid-link-item">
            Contact Us
        </a>

        <a href="profile.php">
            <img src="assets/img/PP/<?php if(isset($_SESSION['user'])){echo $_SESSION['user']['profile_picture'];}else{echo 1;};?>.png" alt="profile icon" width="50" height="50">
        </a>
        <?php
        if(!isset($_SESSION['user'])){
            echo '<a href="login.php" class="mid-link-item">
                        Login
                     </a>';
        }
        ?>
        <div id="theme" class="theme-container">
            <div class="litte-big-ball"></div>
        </div>
    </div>
</div>

<section class="main-section">
    <div style="display: flex; flex-direction: column">

        <h2 class="info">Reservation's Info</h2>


        <div style="background: #C8D6A2; border-radius: 20px; padding: 30px; font-family: 'Montserrat', sans-serif;font-size: 20px;margin: 10px;">
            <h2>
                Global informations:
            </h2>
            <p>Destination: </p>
            <input class="input-trip-valid" value="<?php echo $_SESSION['new_trip']['trip_name']?>" readonly>
            <p>Departure: </p>
            <input class="input-trip-valid" value="<?php echo $_SESSION['new_trip']['start_date']?>" readonly>
            <p>Comeback: </p>
            <input class="input-trip-valid" value="<?php echo $_SESSION['new_trip']['end_date']?>" readonly>
            <p>Duration: </p>
            <input class="input-trip-valid" value="<?php echo $_SESSION['new_trip']['duration']?> days" readonly>
            <p>Number of people: </p>
            <input class="input-trip-valid" value="<?php echo $_SESSION['new_trip']['number']?>" readonly>
        </div>

        <div style="background: #C8D6A2; border-radius: 20px; padding: 30px; font-family: 'Montserrat', sans-serif;font-size: 20px;margin: 10px;display: flex; flex-direction: column; gap: 20px">
            <h2>
                Options:
            </h2>
            <?php


            if($_SESSION['new_trip']['option_1_1'] == 1){
                echo '<div class="option-block">
                        <p>'.$_SESSION['current_trip']['step_type'].': </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_1'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_1_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_1_2'] == 1){
                echo '<div class="option-block">
                        <p>'.$_SESSION['current_trip']['step_type'].': </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_2'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_2_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_1_3'] == 1){
                echo '<div class="option-block">
                        <p>'.$_SESSION['current_trip']['step_type'].': </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_3'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_3_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_1_4'] == 1){
                echo '<div class="option-block">
                        <p>'.$_SESSION['current_trip']['step_type'].': </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_4'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_4_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_1'] == 1){
                echo '<div class="option-block">
                        <p>Vehicle: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_1'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_1_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_2'] == 1){
                echo '<div class="option-block">
                        <p>Vehicle: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_2'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_2_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_3'] == 1){
                echo '<div class="option-block">
                        <p>Vehicle: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_3'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_3_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_4'] == 1){
                echo '<div class="option-block">
                        <p>Vehicle: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_4'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_4_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_1'] == 1){
                echo '<div class="option-block">
                        <p>Activity: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_1'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_1_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_2'] == 1){
                echo '<div class="option-block">
                        <p>Activity: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_2'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_2_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_3'] == 1){
                echo '<div class="option-block">
                        <p>Activity: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_3'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_3_price'] .' $" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_4'] == 1){
                echo '<div class="option-block">
                        <p>Activity: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_4'].'" readonly>
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_4_price'] .' $" readonly>
                    </div>';
            }


            ?>
        </div>
        <div style="background: #C8D6A2; border-radius: 20px; padding: 30px; font-family: 'Montserrat', sans-serif;font-size: 20px;margin: 10px;display: flex; flex-direction: column; gap: 20px">
            <h2>
                Price:
            </h2>

            <?php


            if($_SESSION['new_trip']['option_1_1'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_1_price'] .' $ - '.$_SESSION['current_trip']['option_1_1'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_1_2'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_2_price'] .' $ - '.$_SESSION['current_trip']['option_1_2'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_1_3'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_3_price'] .' $ - '.$_SESSION['current_trip']['option_1_3'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_1_4'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_1_4_price'] .' $ - '.$_SESSION['current_trip']['option_1_4'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_1'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_1_price'] .' $ - '.$_SESSION['current_trip']['option_2_1'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_2'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_2_price'] .' $ - '.$_SESSION['current_trip']['option_2_2'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_3'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_3_price'] .' $ - '.$_SESSION['current_trip']['option_2_3'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_2_4'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_2_4_price'] .' $ - '.$_SESSION['current_trip']['option_2_4'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_1'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_1_price'] .' $ - '.$_SESSION['current_trip']['option_3_1'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_2'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_2_price'] .' $ - '.$_SESSION['current_trip']['option_3_2'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_3'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_3_price'] .' $ - '.$_SESSION['current_trip']['option_3_3'].'" readonly>
                    </div>';
            }
            if($_SESSION['new_trip']['option_3_4'] == 1){
                echo '<div class="option-block">
                        <input class="input-trip-valid" value="'.$_SESSION['current_trip']['option_3_4_price'] .' $ - '.$_SESSION['current_trip']['option_3_4'].'" readonly>
                    </div>';
            }

            if($_SESSION['new_trip']['number'] == 1){
                echo '<div class="option-block">
                        <p>For: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['new_trip']['number'].' person" readonly>
                        
                        <p>Total Price: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['new_trip']['price'].' $" readonly>
                    </div>';
            }else{
                echo '<div class="option-block">
                        <p>For: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['new_trip']['number'].' persons" readonly>
                        
                        <p>Total Price: </p>
                        <input class="input-trip-valid" value="'.$_SESSION['new_trip']['price'].' $" readonly>
                    </div>';
            }




            ?>
        </div>
    </div>

    <div style="width: 200px; margin: auto; display: flex; place-self: center; justify-content: center; gap: 200px">

        <a href="booking.php?id=<?php echo $_SESSION['current_trip']['trip_id']?>">
            <button class="red-light" style="margin: 0">Modify reservation</button>
        </a>

        <form action="assets/php/addBasket.php" method="post">

            <button class="green-light" type='submit'>Valid and add to basket</button>

        </form>


    </div>
</section>

<div id="contact" class="site-footer">
    <div>
        <a href="https://github.com/Akalessio/Projet-MI4E" target="_blank" style="margin-left: 10px; text-decoration: none; font-family: 'Montserrat', sans-serif" class="team-div">
            <h1 class="mid-link-item-contact" style="pointer-events: none">
                Contact :
            </h1>
            <img src="assets/img/team.png" alt="team-logo" width="50" height="50">
            <h1 class="mid-link-item">
                Project-MI4E's team
            </h1>
        </a>
    </div>
    <div class="social-icon">
        <a href="https://www.instagram.com/" target="_blank">
            <img src="assets/img/insta.png" alt="instagram logo" height="75" width="75">
        </a>
        <a href="https://x.com/?lang=fr" target="_blank">
            <img src="assets/img/x.png" alt="x logo" height="50" width="50">
        </a>
        <a href="https://www.facebook.com/?locale=fr_FR" target="_blank" style="margin-left: 20px; margin-right: 20px">
            <img src="assets/img/face.png" alt="facebool logo" height="50" width="50">
        </a>
    </div>
</div>
</body>
</html>
<?php
session_start();

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header("Location:login.php");
    exit();
}


if (!isset($_SESSION['user'])) {
    die('you must be logged');
}


$trip_file = 'assets/php/data/trip_file/' . $_SESSION['user']['trip_file'];

require('assets/php/getapikey.php');

$basket_path = 'assets/php/data/trip_file/'. 'basket_' . $_SESSION['user']['trip_file'];

if (!file_exists($basket_path)) {
    file_put_contents($basket_path, json_encode([], JSON_PRETTY_PRINT));
}

$basket_list = json_decode(file_get_contents($basket_path), true);

$apikey = 'zzzz';
$seller='MI-4_E';
$apikey = getAPIKey($seller);
function generateTransactionID($length = 12) {
    return substr(bin2hex(random_bytes($length)), 0, $length);
}

$transaction_id = generateTransactionID();
$back = "http://localhost:9000/solded.php";

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
<body style="width: 100%; margin: 0; padding: 0; height: 100%; display: flex; flex-direction: column ;justify-content: space-between">
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
        <?php
        if(isset($_SESSION['user'])){
            echo '<a href="basket.php" class="mid-link-item">
                        <img src="assets/img/basket.png" alt="Basket" width="50" height="50">
                     </a>';
        }
        ?>

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

        <h2 class="info">Basket :</h2>

        <?php
        $log = 0;
        $total = 0;
        foreach ($basket_list as $basket){
            $log++;
            $total += $basket['price'];
            $trip_list="assets/php/data/trip_list.json";

            if(file_exists($trip_list)){
                $trips = json_decode(file_get_contents($trip_list), true);
                if($trips==null){
                    die("trip file is empty");
                }
            }else{
                die("trip file dont exist");
            }

            $current_trip='';

            foreach($trips as $trip){
                if($trip['trip_id']==$basket['trip_id']){
                    $cur_tri = $trip;
                }
            }
            echo   '
                <div style="background: #C8D6A2; border-radius: 20px; padding: 30px; font-family: Montserrat, sans-serif;font-size: 20px;margin: 10px;">
                    <h2>
                        Reservation '.$log.':
                    </h2>
                    <p>Destination: </p>
                    <input class="input-trip-valid" value="'.$basket['trip_name'].'" readonly>
                    <p>Departure: </p>
                    <input class="input-trip-valid" value="'.$basket['start_date'].'" readonly>
                    <p>Comeback: </p>
                    <input class="input-trip-valid" value="'.$basket['end_date'].'" readonly>
                    <p>Duration: </p>
                    <input class="input-trip-valid" value="'.$basket['duration'].'days" readonly>
                    <p>Number of people: </p>
                    <input class="input-trip-valid" value="'.$basket['number'].'" readonly>
                    <p>Price: </p>
                    <input class="input-trip-valid" value="'.$basket['price'].'$" readonly>
                    
                    <button class="red-light remove-btn" style="margin-top: 50px; margin-left: 0; width: 20px" data-trip-id="'.$basket['trip_id'].'">Remove</button>

                </div>
            ';

        }
        $control = md5($apikey . "#" . $transaction_id . "#" . (int)$total . "#" . $seller . "#" . $back . "#");
        ?>
        

    <div style="width: 200px; margin: auto; display: flex; place-self: center; justify-content: center; gap: 200px">

            <form action="https://www.plateforme-smc.fr/cybank/index.php" method="post">

                    <input type='hidden' name='transaction' value='<?= $transaction_id ?>'>

                    <input type='hidden' name='montant' value='<?= $total ?>'>

                    <input type='hidden' name='vendeur' value='<?= $seller ?>'>

                    <input type='hidden' name='retour' value='<?= $back ?>'>

                    <input type='hidden' name='control' value='<?= $control ?>'>

                <?php
                    if ($basket_list != []){
                        echo '
                            <input class="green-light" type="submit" value="Valid and Pay">
                        ';
                    }
                ?>



            </form>


    </div>
</section>


<br>
<br>
<br>


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

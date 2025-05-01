<?php
session_start();

if (isset($_GET['status'])) {
    $id = $_GET['status'];
    if ($id == 'accepted') {
        $trip_file = 'assets/php/data/trip_file/' . $_SESSION['user']['trip_file'];

        if (file_exists($trip_file)) {
            $check = false;
            $trip = json_decode(file_get_contents($trip_file), true);
            foreach ($trip as $trips) {
                if($trips['start_date'] == $_SESSION['new_trip']['start_date']){
                    $check = true;
                }
            }if (!$check){
                $trip[] = $_SESSION['new_trip'];
                if (file_put_contents($trip_file, json_encode($trip, JSON_PRETTY_PRINT)) === false) {
                    die("Error writing to file.");
                }
            }
        }
    }
}

?>

    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
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
                color:#41e00b;
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

<div class="form-container-23">
    <div class="form">

            <div class="form-item" style="margin: 50px">
                <label for="loginMail" class="label-text">Purchase's status :</label>
                <input type="email" id="loginMail" name="loginMail" required class="input" value="<?= $_GET['status'] ?>" readonly>
            </div>
            <div class="form-item" style="margin-bottom: 50px">
                <label for="psw" class="label-text">Transaction's Id :</label>
                <input type="text" id="psw" name="psw" required class="input" value="<?= $_GET['transaction'] ?>" readonly>
            </div>
            <div class="form-item" style="margin-bottom: 50px">
                <label for="psw" class="label-text">Transaction's Amount :</label>
                <input type="text" id="psw" name="psw" required class="input" value="<?= $_GET['montant'] ?> $" readonly>
            </div>

            <div class="form-item">
                <a href="profile.php">
                    <button style="font-family: 'Montserrat', sans-serif; z-index: 999">Back to your profile</button>
                </a>
            </div>

    </div>
</div>

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
    </html><?php

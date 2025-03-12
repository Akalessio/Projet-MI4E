<?php
session_start();

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link  rel="stylesheet" href="https://db.onlinewebfonts.com/c/485fe91395665a0ac50e25744ff3a19c?family=Get+Schwifty">
</head>
<body style="width: 100%; margin: 0; padding: 0; background: #DCDFDA">
<div class="site-header">
    <div class="title">
        <h2>
            <a href="index.php">
                <span style=" font-family: 'Get Schwifty', sans-serif;
                font-size: 48px;
                font-weight: bold;
                color: white;
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
                <i class="search"></i>
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
    </div>
</div>

<div class="main-div">
    <a href="triplist.php" class="link-portal-img">
        <img src="assets/img/portal2.png" alt="portal image" class="main-portal">
    </a>
    <a href="triplist.php" class="link-portal-text">
        Travel Now!
    </a>
</div>

<div class="headliner-box">
    <a id="new" href="#new" style="text-align: left; margin-left: 10px; font-family: Montserrat, sans-serif; font-size: 4vw; text-decoration: none">\New</a>
    <div class="headliner-div">

        <div>
            <a href="book.php">
                <img src="assets/img/trip/starwars.png" alt="Star Wars Picture" class="headliner-item">
            </a>
        </div>
        <div>
            <a href="book.php">
                <img src="assets/img/trip/jp.png" alt="Jurassic park Picture" class="headliner-item">
            </a>
        </div>
        <div>
            <a href="book.php">
                <img src="assets/img/trip/hobbit.png" alt="hobbit Picture" class="headliner-item">
            </a>
        </div>
        <div>
            <a href="book.php">
                <img src="assets/img/trip/hp.png" alt="Harry Potter Picture" class="headliner-item">
            </a>
        </div>
        <div>
            <a href="book.php">
                <img src="assets/img/trip/avatar.png" alt="Avatar Picture" class="headliner-item">
            </a>
        </div>
        <div>
            <a href="book.php">
                <img src="assets/img/trip/arcane.png" alt="Arcane Picture" class="headliner-item">
            </a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

</div>

<div class="site-presentation-div">
<h1 class="site-presentation-title">
    Travel with Dimension'Trip
</h1>
<p class="site-presentation-text">
    You've always dreamt about visiting your favorite fiction universe<br>
    with <a href="index.php" style="color: #8FB43A;  text-decoration: none" class="site-presentation-text">Dimension'Trip</a> it's now possible<br>
    <a href="book.php" style="text-decoration: none;color: #8FB43A;">choose your favorite fiction universe</a>, a date, and take your credit card out<br>
    and we will find you the hotel for the vacation of your dream<br>
</p>
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
</html>
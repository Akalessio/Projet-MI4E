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
    <link rel="stylesheet" href="assets/css/book.css">
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
    </div>
</div>

<section class="main-section">
    <div class="book-presentation">
        <div>
            <h1 style="font-family: 'Montserrat', sans-serif; font-size: 30px; background: #8FB43A; color: #DCDFDA; text-align: center; border-radius: 30px">
                Star Wars Trip (template for all the trip)
            </h1>
        </div>
        <div class="main-presentation">
            You've always wanted to meet a Jedi, a Sith or even both ?<br>
            It's your day!!!<br>
            With <a href="index.php" style="font-family: 'Get Schwifty', sans-serif; text-decoration: none; color: black">dimension'<samp style="color: #8FB43A; font-family: 'Get Schwifty', sans-serif">trip</samp></a>
            you can now visit the Star wars universe with our trip you can choose some option to custom your dream adventure <br>
            you can choose a planet to spend your whole trip, many activity for the trip (max amount of 3) and a vehicle that will allow you to travel on the planet and even explore it if you want<br>
            the availible option are :<br>
        </div>
        <div class="options-box">
            <div class="options-presentation">
                <br><h2>Planet:</h2><br>
                <h3>Tatooine:</h3> A beautiful desert planet with many villages and market which will allow you to meet and trade with the locals but be careful it's a dangerous planets with it's lots of foes and treats<br>
                <h3>Endor:</h3> this forest planet is full of life and lakes, the landscapes are beatiful and if you like to hike you'll fall in love with this planet, maybe you'll meet one of the cute but not to be underestimate ewok<br>
                <h3>Coruscant:</h3> This Ecumenopolis, is the center of the galaxy in terms of economy and politics (don't go to deep)<br>
                <h3>Naboo:</h3> this exotics planet full of grassy hills and swampy lake is a planet known for being the birthplace of palpatine<br>
            </div>
            <div class="options-presentation">
                <br><h2>Vehicle:</h2><br>
                <h3>X-wings:</h3> This ship is a military ship it could be useful depending on what you're are trying to do<br>
                <h3>Speeder:</h3> This Hovercraft allow for fast travel on land, many planet like tatooine a known for their speerder's races<br>
                <h3>Millennium Falcon:</h3> one of the fastest if not the fastest ship of the whole galaxy<br>
                <h3>TIE Interceptor:</h3> this TIE vessels will please all the empire enjoyer<br>
            </div>
            <div class="options-presentation">
                <br><h2>Activities:</h2><br>
                <h3>Build your own lightsaber:</h3> Build you own lightsaber with a true kyber crystal and the help of a jedi<br>
                <h3>Learn the way of the forces:</h3> A whole training with a jedi (be careful not everybody is worth enough to be a jedi)<br>
                <h3>Eat some local alien food:</h3> eating food on a 5-star restaurant and try some new things<br>
                <h3>Speeder Racing:</h3> watch or take part in a Speeder Race<br>
            </div>
        </div>
    </div>

    <div class="book-features">

        <div class="book-pic">
            <div class="pic-container">
                <img src="assets/img/trip/st/1.png" alt="endor-picture" class="pic">
            </div>
            <div class="pic-container">
                <img src="assets/img/trip/st/2.png" alt="endor-picture" class="pic">
            </div>
            <div class="pic-container">
                <img src="assets/img/trip/st/3.png" alt="endor-picture" class="pic">
            </div>
        </div>

        <div class="book-options">
            <div class="options">
                <h2>Planet</h2>
                <button class="options-button">Tatooine</button>
                <button class="options-button">Endor</button>
                <button class="options-button">Coruscant</button>
                <button class="options-button">Naboo</button>
            </div>
            <div class="options">
                <h2>Vehicle</h2>
                <button class="options-button">X-wings</button>
                <button class="options-button">Speeder</button>
                <button class="options-button">Millennium Falcon</button>
                <button class="options-button">TIE Interceptor</button>
            </div>
            <div class="options">
                <h2>Activity</h2>
                <button class="options-button">Build your own lightsaber</button>
                <button class="options-button">Learn the way of the forces</button>
                <button class="options-button">Eat some local alien food</button>
                <button class="options-button">Speeder Racing</button>
            </div>
        </div>

        <div style="width: 200px; margin: auto">
            <button class="options-button" style="margin: 0">BOOK</button>
        </div>


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
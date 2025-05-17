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
        <a href="triplist.php" id="here">
           <u>Book a trip</u>
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

<section class="body-section">
    <div class="title-section">
        <p>
            Our Destinations
        </p>
    </div>
    <div class="selection-field">

        <input type="text" placeholder="Search..." class="input-trip">

        <select id="Dimension-Type" class="input-trip" placeholder="Dimension Type">
            <option value="">All Types</option>
            <option value="sf">SF</option>
            <option value="fantasy">Fantasy</option>
            <option value="animation">Animation</option>
            <option value="dystopia">Dystopia</option>
        </select>

        <select id="sort-price" class="input-trip">
            <option value="">Sort by Price</option>
            <option value="asc">Price: Low → High</option>
            <option value="desc">Price: High → Low</option>
        </select>

    </div>
    <div class="trip-list">
        <div class="headliner-item" data-type="sf" data-price="1500">
            <a href="book.php?id=1" >
                <img src="assets/img/trip/starwars.png" alt="Star Wars Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Star Wars</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="1500">
            <a href="book.php?id=3">
                <img src="assets/img/trip/jp.png" alt="Jurassic park Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Jurassic Park</div>
            </a>
        </div>
        <div class="headliner-item" data-type="fantasy" data-price="1500">
            <a href="book.php?id=6">
                <img src="assets/img/trip/hobbit.png" alt="hobbit Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Hobbit</div>
            </a>
        </div>
        <div class="headliner-item" data-type="fantasy" data-price="1500">
            <a href="book.php?id=4">
                <img src="assets/img/trip/hp.png" alt="Harry Potter Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Harry Potter</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="1500">
            <a href="book.php?id=2">
                <img src="assets/img/trip/avatar.png" alt="Avatar Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Avatar</div>
            </a>
        </div>
        <div class="headliner-item" data-type="animation" data-price="1500">
            <a href="book.php?id=5">
                <img src="assets/img/trip/arcane.png" alt="Arcane Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Arcane</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="1600">
            <a href="book.php?id=7">
                <img src="assets/img/trip/startrek.png" alt="Star Trek Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Star Trek</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="1800">
            <a href="book.php?id=8">
                <img src="assets/img/trip/dune.png" alt="Dune Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Dune</div>
            </a>
        </div>
        <div class="headliner-item" data-type="dystopia" data-price="2000">
            <a href="book.php?id=9">
                <img src="assets/img/trip/cyberpunk.png" alt="Cyberpunk Picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Cyberpunk</div>
            </a>
        </div>
        <div class="headliner-item" data-type="dystopia" data-price="1800">
            <a href="book.php?id=10">
                <img src="assets/img/trip/walkingdead.png" alt="walkingdead picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">The walking dead</div>
            </a>
        </div>
        <div class="headliner-item" data-type="animation" data-price="1500">
            <a href="book.php?id=11">
                <img src="assets/img/trip/pokemon.png" alt="pokemon picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Pokemon</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="1800">
            <a href="book.php?id=12">
                <img src="assets/img/trip/doctorwho.png" alt="doctorwho picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Doctor Who</div>
            </a>
        </div>
        <div class="headliner-item" data-type="dystopia" data-price="1850">
            <a href="book.php?id=13">
                <img src="assets/img/trip/warhammer.png" alt="warhammer picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Warhammer</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="2000">
            <a href="book.php?id=14">
                <img src="assets/img/trip/heroes.png" alt="heroes picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Heroes</div>
            </a>
        </div>
        <div class="headliner-item" data-type="sf" data-price="2200">
            <a href="book.php?id=15">
                <img src="assets/img/trip/masseffect.png" alt="masseffect picture" style="width: 300px; height: 200px; border-radius: 30px;">
                <div class="hover-text">Mass Effect</div>
            </a>
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